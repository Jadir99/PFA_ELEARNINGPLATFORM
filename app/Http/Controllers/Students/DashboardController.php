<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $student_info = Student::find(currentUserId());
        $enrollment = Enrollment::where('student_id', currentUserId())->get();
        $course = Course::get();
        $checkout = Checkout::where('student_id', currentUserId())->get();

        #recommendation based en cf-autoencoder
        $userId = currentUserId();
        $response = Http::post("http://127.0.0.1:5000/recommend-cf", [
            'user_id' => $userId
        ]);
        if ($response->successful()) {
            $ids_recommended =$response->json();
            $CF_recommended = Course::whereIn('id', $ids_recommended)->get();
        }
        // dd($CF_recommended );
        // $purchaseHistory = Enrollment::with(['course', 'checkout'])->orderBy('enrollment_date', 'desc')->get();
        return view('students.dashboard', compact('student_info','enrollment', 'course','checkout','CF_recommended'));
    }
}
