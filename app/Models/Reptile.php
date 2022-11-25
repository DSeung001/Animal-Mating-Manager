<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reptile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function scopeListByUserId($query, $userId)
    {
        return $query->select("id", "name")->where("user_id", $userId);
    }

    public function scopeConditionGender($query, $gender = "u")
    {
        return $query->where("gender", $gender);
    }

    public function scopeSearchByName($query, $searchString)
    {
        return $query->where("name", "like", "%".$searchString."%");
    }
}
