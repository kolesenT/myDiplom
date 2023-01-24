<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_new',
        'code_old',
        'is_use'
    ];

    protected $hidden =[
        'code_new',
        'code_old',
    ];

    protected $attributes = [
        'is_use' => 0,
    ];

    public function codeNew():Attribute
    {
        //$this->attributes['code_new'] = $this->generate_code(10);
        return Attribute::make(set: fn ($value) => $this->generate_code(10));
    }

    private function generate_code(int $number): string
    {
        $arr =[
            'a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0', '(', ')',
            '[', ']', '!', '?', '&', '^',
            '%', '@', '*', '$', '<', '>',
            '/', '|', '+', '-', '{', '}',
            '`', '~', '=', 'w', 'W', ':'
        ];
        $code = '';
        for ($i = 0; $i < $number; $i++)
        {
            $index = rand(0, count($arr) - 1);
            $code .= $arr[$index];
        }
        return $code;
    }
}
