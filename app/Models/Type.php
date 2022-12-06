<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Type extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeListByUserId($query, $userId){
        return $query->select('id','name')->where('user_id', $userId);
    }

    public function scopeSearchByName($query, $searchString)
    {
        return $query->where("name", "like", "%$searchString%");
    }

    /**
     * 타입 리스트(pluck: id => name)
     * @return mixed
     */
    public function getTypePluck()
    {
        return $this
            ->select('id', 'name')
            ->listByUserId(Auth::id())
            ->pluck('name', 'id');
    }
}
