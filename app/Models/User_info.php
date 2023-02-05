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
        'surname',
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
            get: function ($value, $attributes) {
                return  $attributes['surname'] . ' ' .
                        $attributes['name'] . ' ' .
                        $attributes['patronymic'];
            }
        );
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function code()
    {
        return $this->belongsTo(Code::class);
    }

    public function schoolClass()
    {
        return $this -> belongsToMany(
            SchoolClass::class,
            'class_user_info',
            'user_info_id',
            'class_id'
        );
    }

    public function grades()
    {
        return $this -> hasMany(Grade::class);
    }
}
