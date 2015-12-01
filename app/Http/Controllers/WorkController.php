<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Work;
use App\Task;
use App\ScheduleDaily;
use App\ScheduleDailyDay;
use App\ScheduleWeekly;
use App\ScheduleMonthly;
use App\ScheduleSemesterly;
use App\ScheduleYearly;
use App\WorkForm;
use App\User;
use App\GroupJob;
use App\Job;
use Response;

use App\TaskUser;
use App\TaskUserJob;
use App\TaskUserJobWork;
use App\TaskUserJobWorkForm;

use DateTime;
use DateTimeZone;

use Config;

class WorkController extends Controller
{
    private function numericDay($day) {

        switch ($day) {
            case "MONDAY" :
                $dayNumber = 0;
            break;

            case "TUESDAY" :
                $dayNumber = 1;
            break;

            case "WEDNESDAY" :
                $dayNumber = 2;
            break;

            case "THURSDAY" :
                $dayNumber = 3;
            break;

            case "FRIDAY" :
                $dayNumber = 4;
            break;

            case "SATURDAY" :
                $dayNumber = 5;
            break;

            case "SUNDAY" :
                $dayNumber = 6;
            break;
        }
        return $dayNumber;
    }

    private function wordDay($day) {
        switch ($day) {
            case "0" :
                $dayWord = "MONDAY";
            break;

            case "1" :
                $dayWord = "TUESDAY";
            break;

            case "2" :
                $dayWord = "WEDNESDAY";
            break;

            case "3" :
                $dayWord = "THURSDAY";
            break;

            case "4" :
                $dayWord = "FRIDAY";
            break;

            case "5" :
                $dayWord = "SATURDAY";
            break;

            case "6" :
                $dayWord = "SUNDAY";
            break;
        }
        return $dayWord;
    }

    private function storeSchedule(Request $request, $work) {
        switch($request->input('type')) {
            case '1':
                $daily = new ScheduleDaily;
                $daily->touch();
                $daily->works()->save($work);
                foreach($request->input('days') as $key => $value) {
                    $dailyDay = new ScheduleDailyDay;
                    $dailyDay->schedule_daily_id = $daily->id;
                    $dailyDay->day = $this->numericDay($value);
                    $dailyDay->touch();
                    $dailyDay->save();
                }

                return $daily;
            break;

            case '2': 
                $weekly = new ScheduleWeekly;
                $weekly->day_start = $request->input('day_start');
                $weekly->touch();
                $weekly->works()->save($work);
                return $weekly;
            break;

            case '3':
                $monthly = new ScheduleMonthly;
                $monthly->date_start = $request->input('date');
                $monthly->touch();
                $monthly->works()->save($work);
                return $monthly;
            break;

            case '4':
                $semesterly = new ScheduleSemesterly;
                $semesterly->touch();
                $semesterly->works()->save($work);
                return $semesterly;
            break;

            case '5':
                $yearly = new ScheduleYearly;
                $yearly->date_start = $request->input('dateMonth');
                $yearly->month_start = $request->input('month');
                $yearly->touch();
                $yearly->works()->save($work);
                return $yearly;
            break;
        }
    }

    private function destroySchedule($work) {
        switch($work->type) {
            case '1':
                ScheduleDaily::find($work->schedule_id)->delete();
            break;
            case '2': 
                ScheduleWeekly::find($work->schedule_id)->delete();
            break;
            case '3':
                ScheduleMonthly::find($work->schedule_id)->delete();
            break;
            case '4':
                ScheduleSemesterly::find($work->schedule_id)->delete();
            break;
            case '5':
                ScheduleYearly::find($work->schedule_id)->delete();
            break;
        }
    }

    private function createEvent($request, $work, $eventName, $schedule) {
        if ($request->input('ended')) {
            $ended = "ENDS '" . $this->fromUtcToLocal($request->input('ended'))->toString() . "'";
        } else {
            $ended = "";
        }
        
        switch($request->input('type')) {
            case '1':
                $scheduleDay = "";
                foreach($request->input('days') as $key => $value) {
                    if ($scheduleDay) $scheduleDay .= ' OR ';
                    $scheduleDay .= "WEEKDAY(CURRENT_DATE) = " . $this->numericDay($value) . " ";
                }

                DB::unprepared("
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 DAY
                            STARTS '" . $this->fromUtcToLocal($request->input('start'))->toString() . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        DISABLE
                        DO BEGIN
                            IF (" . $scheduleDay . ") THEN
                                " . $this->eventInsertStatement($work->id, "1") . "
                            END IF;
                        END
                ");
                
            break;

            case '2': 

                $start = DB::select(DB::raw("SELECT next_weekday('" . $this->fromUtcToLocal($request->input('start'))->toString() . "', " . $schedule->day_start . ") AS 'start';"));

                DB::unprepared("
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 WEEK
                            STARTS '" . $start[0]->start . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        DISABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "2") . "
                        END
                ");
            break;

            case '3':      
                $start = DB::select(DB::raw("SELECT next_month('" . $this->fromUtcToLocal($request->input('start'))->toString() . "', " . $schedule->date_start . ") AS 'start';"));

                DB::unprepared("
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 MONTH
                            STARTS '" . $start[0]->start . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        DISABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "3") . "
                        END
                ");
            break;

            case '4':   
                DB::unprepared("
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 DAY
                            STARTS '" . $this->fromUtcToLocal($request->input('start'))->toString() . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        ENABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "4") . "
                        END
                ");  
            break;

            case '5':  
                DB::unprepared("
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 YEAR
                            STARTS '" . $this->fromUtcToLocal($request->input('start'))->toString() . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        ENABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "5") . "
                        END
                ");              
            break;
        }
    }
    
    private function alterEvent($request, $work, $eventName, $schedule) {
        
        if ($request->input('ended')) {
            $ended = "ENDS '" . $this->fromUtcToLocal($request->input('ended'))->toString() . "'";
        } else {
            $ended = "";
        }
        
        switch($request->input('type')) {
            case '1':
                $scheduleDay = "";
                foreach($request->input('days') as $key => $value) {
                    if ($scheduleDay) $scheduleDay .= ' OR ';
                    $scheduleDay .= "WEEKDAY(CURRENT_DATE) = " . $this->numericDay($value) . " ";
                }

                DB::unprepared("
                    DROP EVENT " . $eventName . ";
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 DAY
                            STARTS '" . $this->fromUtcToLocal($request->input('start'))->toString() . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        ENABLE
                        DO BEGIN
                            IF (" . $scheduleDay . ") THEN
                                " . $this->eventInsertStatement($work->id, "1") . "
                            END IF;
                        END
                ");
                
            break;

            case '2': 

                $start = DB::select(DB::raw("SELECT next_weekday('" . $this->fromUtcToLocal($request->input('start'))->toString() . "', " . $schedule->day_start . ") AS 'start';"));

                DB::unprepared("
                    DROP EVENT " . $eventName . ";
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 WEEK
                            STARTS '" . $start[0]->start . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        ENABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "2") . "
                        END
                ");
            break;

            case '3':      
                $start = DB::select(DB::raw("SELECT next_month('" . $this->fromUtcToLocal($request->input('start'))->toString() . "', " . $schedule->date_start . ") AS 'start';"));

                DB::unprepared("
                    DROP EVENT " . $eventName . ";
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 MONTH
                            STARTS '" . $start[0]->start . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        ENABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "3") . "
                        END
                ");
            break;

            case '4':   
                DB::unprepared("
                    DROP EVENT " . $eventName . ";
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 DAY
                            STARTS '" . $this->fromUtcToLocal($request->input('start'))->toString() . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        ENABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "4") . "
                        END
                ");  
            break;

            case '5':  
                DB::unprepared("
                    DROP EVENT " . $eventName . ";
                    CREATE EVENT " . $eventName . "  
                        ON SCHEDULE 
                            EVERY 1 YEAR
                            STARTS '" . $this->fromUtcToLocal($request->input('start'))->toString() . "'
                            " . $ended . "
                        ON COMPLETION PRESERVE
                        ENABLE
                        DO BEGIN
                            " . $this->eventInsertStatement($work->id, "5") . "
                        END
                ");              
            break;
        }
    }
    
    

    private function eventInsertStatement($id, $type) {
        $insertStatement = "";
        switch ($type) {
            case "1":
                $insertStatement = "
                    CALL task_daily_insert_procedure(" . $id . ");
                ";
            break;

            case "2":
                $insertStatement = "
                    CALL task_weekly_insert_procedure(" . $id . ");
                ";
            break;

            case "3":
                $insertStatement = "
                    CALL task_monthly_insert_procedure(" . $id . ");
                ";
            break;
            
            case "4":
                $insertStatement = "
                    CALL task_semesterly_insert_procedure(" . $id . ");
                ";
            break;
            
            case "5":
                $insertStatement = "
                    CALL task_yearly_insert_procedure(" . $id . ");
                ";
            break;
        }

        return $insertStatement;
        
    }

    public function index()
    {
        $work = Work::with('groupJob')->with('forms')->get();
        foreach ($work as $key => $value) {
            $event = DB::select("
            SELECT name, status FROM mysql.event WHERE name = '" . $value->schedule_name . "'");
            if(count($event) > 0){
                $work[$key]['schedule_status'] = $event[0]->status;
            } else {
                $work[$key]['schedule_status'] = 'DISABLED';
            }
            
        }
        
        return $work;
    }

    public function store(Request $request)
    {
        $eventName = strtoupper(preg_replace('/\s+/', '', $request->input('name') . "_" . date("YmdHis")));

        $work = new Work;
        $work->name = $request->input('name');
        $work->description = $request->input('description');
        
        //$zentot = new Controller;
        $work->start = $this->fromUtcToLocal($request->input('start'))->toDate();
        
        //$work->start = $request->input('start');
        
        
        if ($request->input('ended')) {
            $work->ended = $this->fromUtcToLocal($request->input('ended'))->toDate();
        }
        $work->group_job_id = $request->input('group_job_id');
        $work->type = $request->input('type');
        $work->schedule_name = $eventName;
        $work->schedule_status = "1";
        $work->touch();
        
        $schedule = $this->storeSchedule($request, $work);

        foreach($request->input('forms') as $key => $value) {
            $workForm = new WorkForm;
            $workForm->work_id = $work->id;
            $workForm->form_id = $value['id'];
            $workForm->touch();
            $workForm->save();
        }

        $this->createEvent($request, $work, $eventName, $schedule);
    }

    public function show($id)
    {

        $work =  Work::with('schedule')->with('forms.instruction.guide.standardDocument.standard')->find($id);

        if ($work->type == "1") {
            $temp = $work->schedule()->with('days')->get();
            $work = json_decode(json_encode($work), true);
            foreach($temp as $key1 => $value1) {
                foreach ($value1['days'] as $key2 => $value2) {
                    //return $this->wordDay($value2['day']);
                    $dateWord = $this->wordDay($value2['day']);
                    $value2['day'] = $dateWord;
                }
            }
            $work['schedule'] = $temp;
        }
        
        return response()->json($work);
    }

    public function update(Request $request, $id)
    {
        $work = Work::find($id);
        $work->name = $request->input('name');
        $work->description = $request->input('description');
        
        $work->start = $this->fromUtcToLocal($request->input('start'))->toDate();
        
        if ($request->input('ended')) {
            $work->ended =$this->fromUtcToLocal($request->input('ended'))->toDate();
        } else {
            $work->ended = null;
        }
        $work->group_job_id = $request->input('group_job_id');        
        $work->schedule_status = "1";
        $work->touch();
        
        //if user change schedule method
        if ($work->type !== $request->input('type')) {
            
            $this->destroySchedule($work);

            $work->type = $request->input('type');
            
            $schedule = $this->storeSchedule($request, $work);
            
        } else {
            $schedule = null;
            //if schedule type still same
            switch($request->input('type')) {
                case '1':
                    $daily = ScheduleDaily::find($work->schedule_id);
                    $daily->touch();
                    $work->type = $request->input('type');
                    $daily->works()->save($work);
                    ScheduleDailyDay::where('schedule_daily_id', '=', $daily->id)->delete();
                    foreach($request->input('days') as $key => $value) {
                        $dailyDay = new ScheduleDailyDay;
                        $dailyDay->schedule_daily_id = $daily->id;
                        $dailyDay->day = $this->numericDay($value);
                        $dailyDay->touch();
                        $dailyDay->save();
                    }
                break;

                case '2': 
                    $weekly = ScheduleWeekly::find($work->schedule_id);
                    $weekly->day_start = $request->input('day_start');
                    $weekly->touch();
                    $work->type = $request->input('type');
                    $weekly->works()->save($work);
                    
                    $schedule = $weekly;
                break;

                case '3':
                    $monthly = ScheduleMonthly::find($work->schedule_id);
                    $monthly->date_start = $request->input('date');
                    $monthly->touch();
                    $work->type = $request->input('type');
                    $monthly->works()->save($work);
                    
                    $schedule = $monthly;
                break;

                case '4':
                    $semesterly = ScheduleSemesterly::find($work->schedule_id);
                    $semesterly->touch();
                    $work->type = $request->input('type');
                    $semesterly->works()->save($work);
                break;

                case '5':
                    $yearly = ScheduleYearly::find($work->schedule_id);
                    $yearly->date_start = $request->input('dateMonth');
                    $yearly->month_start = $request->input('month');
                    $yearly->touch();
                    $work->type = $request->input('type');
                    $yearly->works()->save($work);
                break;
            } 
        }
        
        $this->alterEvent($request, $work, $work->schedule_name, $schedule);
    }

    public function destroy($id)
    {
        $work = Work::find($id);
        
        $this->destroySchedule($work);
        
        $work->delete();
    }

    public function execute($id) 
    {
        $work = Work::with('groupJob')->find($id);    

        switch($work->type) {
            case '1': DB::unprepared("" . $this->eventInsertStatement($id, "1") . ""); break;
            case '2': DB::unprepared("" . $this->eventInsertStatement($id, "2") . ""); break;
            case '3': DB::unprepared("" . $this->eventInsertStatement($id, "3") . ""); break;
            case '4': DB::unprepared("" . $this->eventInsertStatement($id, "4") . ""); break;
            case '5': DB::unprepared("" . $this->eventInsertStatement($id, "5") . ""); break;
        }
        
        
        
            $event = DB::select("
            SELECT name, status FROM mysql.event WHERE name = '" . $work->schedule_name . "'");
            if(count($event) > 0){
                $work->schedule_status = $event[0]->status;
            } else {
                $work->schedule_status = 'DISABLED';
            }
            
        
        
        return response()->json($work);
        //return $this->eventInsertStatement($id, "CURRENT_TIMESTAMP() + INTERVAL 1 DAY", $work->type);
    }

    public function eventToggle($id) {
        $work = Work::find($id);
        if ($work->schedule_status == 0) {
            $status = 'ENABLE';
            $work->schedule_status = 1;
        } else {
            $status = 'DISABLE';
            $work->schedule_status = 0;
        }
        
        $work->touch();
        
        DB::unprepared("ALTER EVENT " . $work->schedule_name . " " . $status); 
        
        $work->save();
        
    }

    public function validatingName($name, $id=false)
    {
        if ($id) {
            return Work::where('name', '=', $name)
                ->where('id', '<>', $id)
                ->get();
        } else {
            return Work::where('name', '=', $name)
                ->get();    
        }
    }

    public function startAllEvent() {
        $work = Work::get();
        foreach ($work as $key => $value) {
            DB::unprepared("ALTER EVENT " . $value->schedule_name . " " . 'ENABLE'); 
        }
        $work = Work::where('schedule_status', '=', '0')->update(['schedule_status' => '1']);
        
    }

    public function pauseAllEvent() {
        $work = Work::get();
        foreach ($work as $key => $value) {
            DB::unprepared("ALTER EVENT " . $value->schedule_name . " " . 'DISABLE'); 
        }
        $work = Work::where('schedule_status', '=', '1')->update(['schedule_status' => '0']);
        //$work->update(['schedule_status' => '0']);
    }

    public function executeAllWork() {
        $work = Work::get();    

        foreach($work as $key => $value) {
            switch($value->type) {
                case '1':
                    DB::unprepared("" . $this->eventInsertStatement($value->id, "1") . "");
                break;
                case '2': 
                    DB::unprepared("" . $this->eventInsertStatement($value->id, "2") . "");
                break;
                case '3':
                    DB::unprepared("" . $this->eventInsertStatement($value->id, "3") . "");
                break;
                case '4':
                    DB::unprepared("" . $this->eventInsertStatement($value->id, "4") . "");
                break;
                case '5':
                    DB::unprepared("" . $this->eventInsertStatement($value->id, "5") . "");
                break;
            }
        }
            
        //return $this->eventInsertStatement($id, "CURRENT_TIMESTAMP() + INTERVAL 1 DAY", $work->type);
    }

    public function users ($id) 
    {
        $temp = User::with(['jobs' => function ($query1) use ($id) {
            $query1->with(['groupJobs' => function ($query2) use ($id) {
                $query2->with(['works' => function ($query3) use ($id) {
                    $query3->where('id', '=', $id)->with('forms');
                }])->whereHas('works', function($query3) use ($id) {
                    $query3->where('id', '=', $id);
                });
            }])->whereHas('groupJobs.works', function($query2) use ($id) {
                $query2->where('id', '=', $id);
            });
        }])->whereHas('jobs.groupJobs.works', function ($query1) use ($id) {
            $query1->where('id', '=', $id);
        })->get();


        return Response::json($temp, $status=200, $headers=[], $options=JSON_PRETTY_PRINT); 
    }
}
