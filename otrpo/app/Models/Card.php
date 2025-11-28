<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    // Разрешаем массовое заполнение этих полей
    protected $fillable = ['title', 'description', 'image'];

}
