<?php

namespace App\Http\Controllers;

use App\Models\Study;
use App\Models\User;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    function createStudyData(Request $request)
    {

        try {
            $request->validate([
                'institute' => 'required|string|max:255',
                'start_date' => 'required|date|max:255',
                'end_date' => 'required|date|max:255',
                'cgpa' => 'required|numeric|max:4',
                'user_id' => 'required|exists:users,id'
            ]);

            Study::create([
                'institute' =>  $request->institute,
                'start_date' =>  $request->start_date,
                'end_date' =>  $request->end_date,
                'cgpa' =>  $request->cgpa,
                'user_id' =>  $request->user_id,
            ]);

            return response()->json([
                'success' => true,
                'msg' => 'study data created successfully',
                
            ]);




        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'msg' => 'study data created failed'.$th->getMessage(),
                
            ]);
        }
        return $request->input();
    }
}
