<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = [
        'num',
        'letter',
    ];

    public function users()
    {
        return $this->belongsToMany(User_info::class, 'class_user_info',
            'class_id', 'user_info_id');
    }
}
