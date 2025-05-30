<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = [];

      public function zoom()
    {
        return $this->belongsTo(Zoom::class);
    }

      public function student()
    {
        return $this->belongsTo(Student::class);
    }

     public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
