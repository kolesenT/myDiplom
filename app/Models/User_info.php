<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    const IS_ADMIN = 'admin';
    const IS_PUPIL = 'pupil';
    const IS_TEACHER = 'teacher';
    const IS_PARENT = 'parent';

    use HasFactory;

    protected $table = 'user_info';

    protected $fillable = [
        'surmane',
        'name',
        'patronymic',
    ];

    protected function surname(): Attribute
    {
        return Attribute::make(set: fn ($value) => ucfirst(strtolower($value)));
    }

    protected function name(): Attribute
    {
        return Attribute::make(set: fn ($value) => ucfirst(strtolower($value)));
    }

    protected function patronymic(): Attribute
    {
        return Attribute::make(set: fn ($value) => ucfirst(strtolower($value)));
    }

    protected function fullname(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => new User_info(
                $attributes['surname'],
                $attributes['name'],
                $attributes['patronymic']
        ),
        );
    }

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
