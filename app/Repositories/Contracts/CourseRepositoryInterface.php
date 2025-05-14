<?php 
namespace App\Repositories\Contracts;
use App\Models\Course;
use Illuminate\Support\Collection;

interface CourseRepositoryInterface
{
    public function getAllCoursesByCategory() : Collection;
    public function searchByKeyword(string $keyword) : Collection;

}

?>