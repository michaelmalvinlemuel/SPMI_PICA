<?php

namespace App\Http\Controllers;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Job;

trait UserTrait {

    public function coordinate() {

        $result = [];

        $user = JWTAuth::parseToken()->authenticate();
        $user = User::with('jobs')->find($user->id);
        $jobs = $user->jobs;

        function pushIfUnique(&$result, $node) {

            foreach($result as $key => $value) {
                if ($node == $value) {
                    return 0;
                }
            }

            array_push($result, $node);
        }

        function metamorph(&$result, $node) {

                unset($node->pivot);
                pushIfUnique($result, $node);


        }

        function subs(&$result, $jobs) {
            foreach($jobs as $key => $value) {
                $job = Job::with('users')->where('job_id', '=', $value->id)->get();
                $jobs[$key]['subs'] = $job;

                foreach($job as $key1 => $value1) {
                    foreach($value1->users as $key2 => $value2) {
                        metamorph($result, $value2);
                    }

                }

                subs($result, $job);
            }
        }

        subs($result, $jobs);

        function removeCurrentUser(&$result, $user) {
            foreach($result as $key => $value) {
                if ($user->id == $value->id) {
                    array_splice($result, $key, 1);
                    return 0;
                }
            }
        }

        removeCurrentUser($result, $user);

        function removeDuplicate(&$result) {

            $temporary_distinct = [];

            foreach ($result as $key => $value) {

                $counter = 0;
                foreach ($temporary_distinct as $key1 => $value1) {

                    if ($value->id == $value1->id) {
                        break;
                    }
                    $counter++;
                }

                if ($counter == count($temporary_distinct)) {
                    array_push($temporary_distinct, $result[$key]);
                }

            }

            $result = $temporary_distinct;

        }

        removeDuplicate($result);

        return $result;
    }

}
