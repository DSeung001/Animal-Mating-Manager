<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egg extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function isHatching(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == "y" ? "해칭 완료" : ($value == "n" ? "해칭 실패" : "기다리는 중")
        );
    }

    protected function spawnAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('Y-m-d', strtotime($value))
        );
    }

    protected function estimatedDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('Y-m-d', strtotime($value))
        );
    }
}
