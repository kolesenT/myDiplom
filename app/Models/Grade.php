<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $dateFormat = [
        'my_date'
    ];

    protected $fillable = [
        'my_date',
        'grade',
    ];

    public function userInfo()
    {
        return $this->belongsTo(User_info::class, 'user_info_id', 'id');
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
}
