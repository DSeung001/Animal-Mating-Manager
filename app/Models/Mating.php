<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mating extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function matingAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('Y-m-d', strtotime($value))
        );
    }
}
