<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function course_name()
    {
      return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
