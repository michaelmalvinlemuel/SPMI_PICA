<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Excel;

use App\Project;
use App\ProjectNode;

use App\ProjectForm;
use App\ProjectFormItem;
use App\Form;
use App\ProjectFormUpload;


use App\Pica;
use App\PicaDetail;

use App\userJob;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class DummyController extends Controller
{

    //use ProjectTrait;

    private $projectPica = [];

  

    public function selectNodeAll($nodes, $parent, &$root, $id) {

    	 foreach($nodes as $key => $value) {

            $projectNode = Project::where('project_id', '=', $value->id)->where('project_type', '<>', 'App\Project')->get();

            if (count($projectNode) > 0) {

              $nodes[$key]['children'] = $projectNode;
              $this->selectNodeAll($projectNode, $nodes[$key], $root, $id);

            } else {

               $projectForm = ProjectForm::where('project_node_id', '=', $value->id)->with('score', 'indicators')->first();
               
                $nodes[$key]['end_node'] = $projectForm;
                array_push($this->projectPica, $nodes[$key]);
            }

        }
    }


    /**
     * Display a listing of the resource.
     *0
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


      
      $user = new \stdClass;
      $user->id = 7;



        $project = Project::with('projects')->where('status', '<>', 0)->where('id', '<', 13)->get();
        foreach ($project as $key => $value) {
            $this->selectNodeAll($value->projects, $value, $project[$key], $user->id);
            $value->nodes = $this->projectPica;
            $this->projectPica = [];
        }

        //return response()->json($this->projectPica);
        return response()->json($project);
    }

    public function assessment ($id) 
    {
      $project = Project::with('projects')->find($id);
      $this->selectNodeAll($project->projects, $project, $project, 1);

      return response()->json($this->projectPica);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
