<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reptile extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function birth(): Attribute
    {
        return Attribute::make(
            get: fn($value) => date('Y-m-d', strtotime($value))
        );
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value == "m" ? "수컷" : ($value == "f" ? "암컷" : "미구분")
        );
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
        return $query->where("name", "like", "%$searchString%");
    }

    /**
     * 성별이 암컷인 개체 리스트(pluck: id => name)
     * @return mixed
     */
    public function getFemaleReptilePluck()
    {
        return $this
            ->select('id', 'name')
            ->listByUserId(Auth::id())
            ->conditionGender('f')
            ->pluck('name', 'id');
    }

    /**
     * 성별이 수컷인 개체 리스트(pluck: id => name)
     * @return mixed
     */
    public function getMaleReptilePluck()
    {
        return $this
            ->select('id', 'name')
            ->listByUserId(Auth::id())
            ->conditionGender('m')
            ->pluck('name', 'id');
    }
}
