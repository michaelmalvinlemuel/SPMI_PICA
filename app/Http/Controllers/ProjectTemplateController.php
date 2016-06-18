<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ProjectTemplate;
use App\ProjectNodeTemplate;
use App\ProjectNodeFormTemplate;
use App\ProjectNodeFormItemTemplate;

use App\Form;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Standard;

class ProjectTemplateController extends Controller
{
    
    /**
     * Insert project node recursively
     *
     */
     
    private function recursiveStore($nodes, $parent) 
    {
        
        foreach ($nodes as $key => $value) {
            
            $projectNode = new ProjectNodeTemplate;
            $projectNode->name = $value['name'];
            $projectNode->description = $value['description'];
            $projectNode->touch();
            $parent->projects()->save($projectNode);
            
            if (count($value['children']) > 0) {
                
                $this->recursiveStore($value['children'], $projectNode);
            
            } else {
                if (isset($value['forms'])) {
                    $projectNodeForm = new ProjectNodeFormTemplate;
                    $projectNodeForm->project_node_template_id = $projectNode->id;
                    
                    if (isset($value['weight'])) {
                        $projectNodeForm->weight = $value['weight'];
                    } else {
                        $projectNodeForm->weight = 0;
                    }
                    
                    $projectNodeForm->touch();
                    $projectNodeForm->save();
                    
                    $forms = $value['forms'];
                    foreach($forms as $key1 => $value1) {
                        $projectNodeFormItem = new ProjectNodeFormItemTemplate;
                        $projectNodeFormItem->project_node_form_template_id = $projectNodeForm['id'];
                        $projectNodeFormItem->form_id = $value1['id'];
                        $projectNodeFormItem->document = $value1['document'];
                        $projectNodeFormItem->touch();
                        $projectNodeFormItem->save();
                    }
                }
            }
            
        }    
    }
    
    private function recursiveShow($nodes, $parent) {
        
        foreach($nodes as $key => $value) {
            
            $projectNode = ProjectNodeTemplate::where('project_template_id', '=', $value->id)
                ->where('project_template_type', '<>', 'App\ProjectTemplate')->get();
            
            if (count($projectNode) > 0) {
                
                foreach($nodes as $key1 => $value1) {
                    $nodes[$key1]['header'] = $value1->name;
                    $nodes[$key1]['label'] = $value1->name;
                }
                
                $nodes[$key]['children'] = $projectNode;
                $nodes[$key]['delegations'] = [];
                $nodes[$key]['assessors'] = [];
                $this->recursiveShow($projectNode, $nodes[$key]);
                
            } else {
                
                $projectNodeForm = ProjectNodeFormTemplate::where('project_node_template_id', '=', $value->id)->first();
                
                if (count($projectNodeForm) > 0) {
                    
                    $projectNodeFormItem = ProjectNodeFormItemTemplate::where('project_node_form_template_id', '=', $projectNodeForm->id)->get();
                    $form = [];
                    
                    foreach ($projectNodeFormItem as $key1 => $value1) {
                        $form[$key1] = Form::with('instruction.guide.standardDocument.standard')->find($value1->form_id);
                        $form[$key1]['project_node_form_item_template_id'] = $value1->id;
                    }
                    
                    foreach($nodes as $key1 => $value1) {
                        $nodes[$key1]['header'] = $value1->name;
                        $nodes[$key1]['label'] = $value1->name;
                    }
                    
                    $nodes[$key]['weight'] = $projectNodeForm->weight;
                    $nodes[$key]['forms'] = $form;
                    
                } else {
                    
                    foreach ($nodes as $key1 => $value1) {
                        $nodes[$key1]['header'] = $value1->name;
                        $nodes[$key1]['label'] = $value1->name;
                    }
                    
                    $nodes[$key]['children'] = [];
                    $nodes[$key]['delegations'] = [];
                    $nodes[$key]['assessors'] = [];
                    $nodes[$key]['weight'] = 0;
                }
                
                $nodes[$key]['children'] = [];
                $nodes[$key]['delegations'] = [];
                $nodes[$key]['assessors'] = [];
                
            }
             
        }
        
    }
    
    /**
     * 
     */
     
     private function recursiveDelete($nodes) {
         
         foreach($nodes->projects as $key => $value) {
             
             $projectNode = ProjectNodeTemplate::find($value->id);
             
             $this->recursiveDelete($projectNode);
             
             $projectNodeForm = ProjectNodeFormTemplate::where('project_node_template_id', '=', $value->id)->get();
             
             foreach($projectNodeForm as $key1 => $value1) {
                 $formItem = $projectNodeForm[$key1]->forms()->get();
                 $projectNodeForm[$key1]->forms()->delete();
             }
             
             $projectNode->forms()->delete();
             
         }
         
         $nodes->delete();
         
     }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate($display)
    {
        $project = ProjectTemplate::paginate($display);
        return response()->json($project);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = ProjectTemplate::where('status','=', '1')->get();
        return response()->json($project);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new ProjectTemplate;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->status = $request->input('status');
        $project->touch();
        
        $projectNode = [];
        $projectNode = $request->input('projects');
        
        $response = $this->recursiveStore($projectNode, $project);
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = ProjectTemplate::with('projects')->find($id);
        foreach($project->projects as $key => $value) {
            $project->projects[$key]['label'] = $value->name;
        }
        
        $this->recursiveShow($project['projects'], $project);
        return response()->json($project);
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
        $project = ProjectTemplate::with('projects')->find($id);
        
        
        foreach($project->projects as $key => $value) {
            $this->recursiveDelete($value);
        }
        
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->status = $request->input('status');
        $project->touch();
        
        $projectNode = [];
        $projectNode = $request->input('projects');
        
        return $this->recursiveStore($projectNode, $project);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = ProjectTemplate::with('projects')->find($id);
        $this->recursiveDelete($project);
        
        $project->delete();
    }
    
    public function monev()
    {
        
        
        /*
        $monev = ProjectNodeTemplate::where('id', '>', '1537');
        $monev->delete();
        
        $standards = Standard::with('standardDocuments')->where('id', '<', '4')->get();
        
        
        foreach ($standards as $key => $value) {
            $projectTemplate = new ProjectNodeTemplate;
            $projectTemplate->name = $value->description;
            $projectTemplate->description = $value->description;
            $projectTemplate->project_template_id = 2;
            $projectTemplate->project_template_type = 'App\ProjectTemplate';
            $projectTemplate->touch();
            $projectTemplate->save();
            
            $projectTemplateChildren = ->standard_documents;
            $projectTemplateChildren = json_decode(json_encode($projectTemplateChildren), false);
            //var_dump($projectTemplateChildren);
            
            
            foreach($projectTemplateChildren as $key2 => $value2) {
                
                $projectTemplateChild = new ProjectNodeTemplate;
                $projectTemplateChild->name = $value2->$description;
                $projectTemplateChild->description = $value2->description;
                $projectTemplateChild->project_template_id = $projectTemplate->id;
                $projectTemplateChild->project_template_type = 'App\ProjectNodeTemplate';
                $projectTemplateChild->touch();
                $projectTemplateChild->save();
                
                $projectTemplateChildMonev = new ProjectNodeTemplate;
                $projectTemplateChildMonev->name = 'Perencanaan';
                $projectTemplateChildMonev->description = 'Perencanaan';
                $projectTemplateChildMonev->project_template_id = $projectTemplateChild->id;
                $projectTemplateChildMonev->project_template_type = 'App\ProjectNodeTemplate';
                $projectTemplateChildMonev->touch();
                $projectTemplateChildMonev->save();
                
                $projectTemplateChildMonev = new ProjectNodeTemplate;
                $projectTemplateChildMonev->name = 'Pelaksanaan';
                $projectTemplateChildMonev->project_template_id = $projectTemplateChild->id;
                $projectTemplateChildMonev->project_template_type = 'App\ProjectNodeTemplate';
                $projectTemplateChildMonev->touch();
                $projectTemplateChildMonev->save();
                
                $projectTemplateChildMonev = new ProjectNodeTemplate;
                $projectTemplateChildMonev->name = 'Evaluasi, Pengendalian dan, Pengembangan';
                $projectTemplateChildMonev->project_template_id = $projectTemplateChild->id;
                $projectTemplateChildMonev->project_template_type = 'App\ProjectNodeTemplate';
                $projectTemplateChildMonev->touch();
                $projectTemplateChildMonev->save();
            }
            
        }
        
        
        //$standards = json_decode(json_encode($standards), false);
        return response()->json($standards);
        */
    }

}
