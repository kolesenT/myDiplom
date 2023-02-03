<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function numLesson()
    {
        return $this->belongsTo(NumLesson::class);
    }
}
