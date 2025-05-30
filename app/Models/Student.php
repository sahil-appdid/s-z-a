<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function attedance()
    {
        return $this->hasMany(Attendance::class);
    }
}
