<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\models\Course;

class CourseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $courses = Course::all();
        return response()->json([
            'status' => 'success',
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'total_videos'=>'required|integer'
        ]);

        $course = Course::create([
            'user_id'=>$request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'total_videos'=>$request->total_videos,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Course created successfully',
            'course' => $course,
        ]);
    }

    public function show($id)
    {
        $course = Course::find($id);
        return response()->json([
            'status' => 'success',
            'course' => $course,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           // 'title' => 'required|string|max:255',
            //'description' => 'required|string|max:255',
            'user_id'=>$request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'total_videos'=>$request->total_videos,
        ]);

        $course = Course::find($id);
        $course->title = $request->User_id;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->total_videos = $request->total_videos;

        $course->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Course updated successfully',
            'course' => $course,
        ]);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Course removed successfully',
            'course' => $course,
        ]);
    }

}
