<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $dateFormat = [
        'my_date'
    ];

    protected $fillable = [
        'my_date',
        'homework',
    ];

    public function class()
    {
        return $this ->belongsTo(SchoolClass::class, 'class_id');
    }

    public function discipline()
    {
        return $this -> belongsTo(Discipline::class);
    }
}
