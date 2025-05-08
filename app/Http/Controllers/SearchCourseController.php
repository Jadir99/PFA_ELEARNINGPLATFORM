<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Http;

class SearchCourseController extends Controller
{
    public function index(Request $request)
    {
        // Fetch categories
        $category = CourseCategory::get();
        
        // Get the selected categories from the request, or default to an empty array
        $selectedCategories = $request->input('categories', []);
    
        // Retrieve courses based on selected categories
        $course = Course::when($selectedCategories, function ($query) use ($selectedCategories) {
            $query->whereIn('course_category_id', $selectedCategories);
        })->get()->take(10);  // This fetches the filtered courses
    
        // Retrieve all courses (no need to call get after all())
        $allCourse = Course::count();  // This retrieves all courses
    
        // Return the view with the necessary data
        return view('frontend.searchCourse', compact('course', 'category', 'selectedCategories', 'allCourse'));
    }


    public function getRecommendations(Request $request)
    {
        $query = $request->input('query');
    
        // Send request to the Flask API for recommendations
        $response = Http::post('http://127.0.0.1:5000/recommend', [
            'query' => $query
        ]);
    
        if ($response->successful()) {
            // Get the list of recommended course IDs
            $recommendedIds = $response->json();
    
            // Fetch the course details using the recommended course IDs
            $courses = Course::whereIn('id', $recommendedIds)->get();
    
            // Pass the courses to the view
            return back()->with('results', $courses);
        } else {
            // If the API request fails, return an error message
            return back()->with('error', 'API request failed');
        }
    }
    
    public function recommendByCourseId(Request $request)
{
    $courseId = $request->input('course_id');

    if (!$courseId) {
        return back()->with('error', 'Missing course_id');
    }

    // // Optional: Validate the courseId if necessary
    // if (!Course::find($courseId)) {
    //     return back()->with('error', 'Invalid course_id');
    // }

    // // Send request to Flask API
    $response = Http::post('http://127.0.0.1:5000/recommend-by-id', [
        'course_id' => $courseId
    ]);
    echo $response;

    if ($response->successful()) {
        $recommendedCoursesData = $response->json();


        // Get detailed Course info from DB
        $courses = Course::whereIn('id', $recommendedCoursesData )->get();
        // dd($courses);
        // Return to view with courses or as JSON
        // return view('courses.recommendations', compact('courses'));  // Returning to a view
        // OR
        return response()->json($courses);  // Returning as JSON response
    } else {
        return back()->with('error', 'Recommendation API request failed');
    }
}
    public function testRecommendation(Request $request)
        {
            $userId = $request->input('user_id');
            $response = Http::post("http://127.0.0.1:5000/recommend-cf", [
                'user_id' => $userId
            ]);
            return $response;
        }
}
