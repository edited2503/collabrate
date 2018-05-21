<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectRating;
class ProjectRatingController extends Controller
{
    //
    public function addProjectRating(Request $request){
      $project_rating = new ProjectRating();

      $project_rating->project_id = $request->project_id;
      $project_rating->user_id = $request->user_id;


      if ($project_rating->save()) {
        $project_rating_count = ProjectRating::where(['project_id' => $request->project_id])->count();  
        return response()->json(['status'=>200,'message'=>'Rating Added','count'=>$project_rating_count]);
      }else{
        return response()->json(['status'=>401,'message'=>'Something went Wrong']);
      }

    }
    public function getNoOfProjectRating($id){
    $count = ProjectRating::where(['project_id' => $id])->count();

    return response()->json(['status'=>200,'count'=>$count]);
    }
    public function checkRatingEligibility($project_id,$user_id){
      $count = ProjectRating::where('user_id', $user_id)->where('project_id' , $project_id)->count();
      if ($count > 0) {
        return response()->json(['status'=>200,'canRate'=>false]);
      } else {
        return response()->json(['status'=>200,'canRate'=>true]);
      }
      // return $count;
    }
    public function removeProjectRating($project_id,$user_id){
      $project_rating = ProjectRating::where('user_id', $user_id)->where('project_id' , $project_id)->delete();
      return response()->json(['status'=>200,'canRate'=>true]);
    }
}
