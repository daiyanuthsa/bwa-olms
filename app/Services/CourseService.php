<?php
namespace App\Services;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    public function enrollUser(Course $course)
    {
        $user = Auth::user();

        // chekk if the user is already enrolled in the course
        if (!$course->courseStudents()->where('user_id', $user->id)->exists()) {
            $course->courseStudents()->create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);
        }

        return $user->name;
    }

    public function getFirstSectionAndContent(Course $course)
    {
        $firstSection = $course->courseSections()
            ->with(['sectionContents' => fn($q) => $q->orderBy('id')])
            ->orderBy('id')
            ->first();

        return [
            'firstSectionId' => $firstSection?->id,
            'firstContentId' => $firstSection?->sectionContents->first()?->id,
        ];
    }

    public function getLearningData(Course $course, $contentSectionId, $sectionContentId)
    {
        $course->load(['courseSections.sectionContents']);

        $currentSection = $course->courseSections->find($contentSectionId);
        $currentContent = $currentSection ? $currentSection->sectionContents->find($sectionContentId) : null;

        // Determine next content
        $nextContent = null;
        if ($currentContent) {
            $nextContent = $currentSection->sectionContents->where('id', '>', $currentContent->id)->sortBy('id')->first();
        }

        // Determine next section
        if (!$nextContent && $currentSection) {
            $nextSection = $course->courseSections
                ->where('id', '>', $currentSection->id)
                ->sortBy('id')->first();

            if ($nextSection) {
                $nextContent = $nextSection->sectionContents->sortBy('id')->first();
            }
        }

        return [
            'course' => $course,
            'currentSection' => $currentSection,
            'currentContent' => $currentContent,
            'nextContent' => $nextContent,
            'is_finished' => !$nextContent,
        ];
    }

}
?>