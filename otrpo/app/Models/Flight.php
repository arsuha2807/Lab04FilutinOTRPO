<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'price', 'release_date', 'image_path'];

    protected $dates = ['release_date'];

   

    public function setReleaseDateAttribute($value)
    {
        $this->attributes['release_date'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

    // Аксессор возвращает дату в читабельном формате
    public function getReleaseDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y');
    }

    // Мутатор для image_path для автоматической обработки путей
    public function setImagePathAttribute($value)
    {
        $this->attributes['image_path'] = trim($value);
    }

    public function getImagePathAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }
}
