<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedCourse extends Model
{
    use HasFactory;
    protected $fillable = [
      'status', // Add 'status' to the fillable fields
      // Other fillable fields if you have any
  ];
    public function course_name()
    {
      return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
