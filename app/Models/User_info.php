<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    const IS_ADMIN = 'admin';
    const IS_PUPIL = 'pupil';
    const IS_TEACHER = 'teacher';
    const IS_PARENT = 'parent';

    use HasFactory;

    protected $table = 'users_info';

    protected $fillable = [
        'surmane',
        'name',
        'patronymic',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function codes()
    {
        return $this->belongsTo(Code::class);
    }
}
