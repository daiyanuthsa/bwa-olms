<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    protected $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    public function index()
    {
        $coursesByCategory = $this->courseService->getCoursesGroupedByCategory();
        return view('courses.index', compact('coursesByCategory'));
    }

    public function details(Course $course)
    {
        $course->load(['category', 'benefits','courseSections.sectionscontents']);
        return view('courses.details', compact('course'));
    }

    public function join(Course $course)
    {
        $studentName = $this->courseService->enrollUser($course);
        $firstSectionAndContent = $this->courseService->getFirstSectionAndContent($course);
        return view('courses.success_joined', array_merge(
            compact('course', 'studentName'),
            $firstSectionAndContent,
        ));
    }
    public function learning(Course $course, $courseSections_id, $sectionContent_id)
    {
        $lerningData = $this->courseService->getLearningData($course, $courseSections_id, $sectionContent_id);
        return view('courses.learning', compact('lerningData'));
    }
    public function learning_finished(Course $course)
    {
        
        return view('courses.learning_finished', compact('course'));
    }

    public function search_courses(Request $request)
    {
        $request->validate([
            'search' => 'required|string|min:3',
        ]);
        $keyword = $request->input('search');
        $courses = $this->courseService->searchCourses($keyword);

        return view('courses.search', compact('courses','keyword'));
    }
}