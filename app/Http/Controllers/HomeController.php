<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ApiResponser;

    //
    public function index(Request $request)
    {
        $local = $request->header('Accept-Language');
        $newCourses = Course::with(['topic', 'topic.subCategory', 'topic.subCategory.category', 'instructor'])
        ->latest()->limit(3)->get();
        $courses = Course::with(['topic', 'topic.subCategory', 'topic.subCategory.category', 'instructor'])->get();
        $categories = Category::get();
        if ($local && $local == 'ar') {
            $courses->each(function ($course) {
                $course->name = $course->name_ar;
                $course->description = $course->description_ar;
                $course->topic->name = $course->topic->name_ar;
                $course->instructor->full_name = $course->topic->full_name_ar;
                return $course;
            });
            $newCourses->each(function ($newCourse) {
                $newCourse->name = $newCourse->name_ar;
                $newCourse->description = $newCourse->description_ar;
                $newCourse->topic->name = $newCourse->topic->name_ar;
                $newCourse->instructor->full_name = $newCourse->topic->full_name_ar;
                return $newCourse;
            });
        }

        return $this->success([
          'newCourses' => $newCourses,
          'courses' => $courses,
          'categories' => $categories
        ]);
    }
}
