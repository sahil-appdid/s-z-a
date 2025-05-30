<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function students()
    {
        return $this->hasOne(Student::class);
    }

    public function zooms()
    {
        return $this->hasOne(Zoom::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
