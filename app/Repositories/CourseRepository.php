<?php
namespace App\Repositories;
use App\Models\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Support\Collection;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAllCoursesByCategory(): Collection
    {
        return Course::with('category')
            ->latest()
            ->get();
    }

    public function searchByKeyword(string $keyword): Collection
    {
        return Course::where('name', 'like', "%{$keyword}%")
            ->orWhere('about', 'like', "%{$keyword}%")
            ->latest()
            ->get();
    }
}
?>