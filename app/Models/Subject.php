<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

     public function batch()
    {
        // return $this->hasOne(Batch::class);
        return $this->belongsTo(Batch::class);

    }
}
