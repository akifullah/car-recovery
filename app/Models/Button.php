<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Button extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'url',
        'target',
    ];
}
