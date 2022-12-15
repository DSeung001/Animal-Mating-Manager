<?php

namespace App\Http\Controllers;

use App\Models\Egg;
use App\Models\Mating;
use App\Models\Reptile;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private Egg $egg;
    private Reptile $reptile;
    private Mating $mating;

    public function __construct(Egg $egg, Mating $mating, Reptile $reptile){
        $this->egg = $egg;
        $this->mating = $mating;
        $this->reptile = $reptile;
    }

    public function dashboard()
    {
        $eggs = $this->egg
            ->select(
                'eggs.id as id',
                'f_reptile.name as father_name',
                'm_reptile.name as mather_name',
                DB::raw("DATE_ADD(spawn_at, INTERVAL hatch_day DAY) as start"))
            ->leftJoin('types', 'types.id', '=', 'type_id')
            ->leftJoin('matings', 'matings.id', '=', 'mating_id')
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->where('eggs.user_id', Auth::id())
            ->get()
            ->toArray();
        $eggs = array_map(function ($egg){
           return [
               'title' => $egg['father_name']."x".$egg['mather_name']." 알",
               'url' => route('egg.show',$egg['id']),
               'start' => $egg['start']
           ];
        }, $eggs);


        /*
         * 수 개체들 전체
         *
         *  => 확대해서 보기 http://jsfiddle.net/fj6d2/3025/
         * 1. 월 카테고리
         * */

        /*
         * 개체수 증가량은 => created_at을 통해 구분 가능
         * min created_at, max created_at을 가져온 후
         * */

        $graphCategories = [];
        $allReptileList = [];
        $maleReptileList =[];
        $femaleReptileList = [];
        $undefinedReptileList = [];

        if($this->reptile->where('id', '!=', '0')->first() !== null){
            $maxCreatedAt = Carbon::parse($this->reptile
                ->select(DB::raw('max(created_at) as created_at'))
                ->where('user_id', Auth::id())
                ->first()['created_at']);
            $minCreatedAt = Carbon::parse($this->reptile
                ->select(DB::raw('min(created_at) as created_at'))
                ->where('user_id', Auth::id())
                ->first()['created_at']);
            $diffMonth = $minCreatedAt->diffInMonths($maxCreatedAt)+1;

            for($re = 0 ; $re <= $diffMonth ; $re++){
                $graphCategories[] = $minCreatedAt->format('Y.m');

                $maleCount = $this->reptile
                    ->select(DB::raw('count(id) as count'))
                    ->where('created_at', 'like', $minCreatedAt->format('Y-m')."%")
                    ->where('user_id', Auth::id())
                    ->conditionGender('m')
                    ->first()['count'];

                $femaleCount = $this->reptile
                    ->select(DB::raw('count(id) as count'))
                    ->where('created_at', 'like', $minCreatedAt->format('Y-m')."%")
                    ->where('user_id', Auth::id())
                    ->conditionGender('f')
                    ->first()['count'];

                $undefinedCount = $this->reptile
                    ->select(DB::raw('count(id) as count'))
                    ->where('created_at', 'like', $minCreatedAt->format('Y-m')."%")
                    ->where('user_id', Auth::id())
                    ->conditionGender()
                    ->first()['count'];

                $allCount = $maleCount + $femaleCount + $undefinedCount;

                if($re > 0){
                    $allReptileList[] = $allReptileList[$re-1] + $allCount;
                    $maleReptileList[] = $maleReptileList[$re-1] + $maleCount;
                    $femaleReptileList[] = $femaleReptileList[$re-1] + $femaleCount;
                    $undefinedReptileList[] = $undefinedReptileList[$re-1] + $undefinedCount;
                } else {
                    $allReptileList[] = $allCount;
                    $maleReptileList[] = $maleCount;
                    $femaleReptileList[] = $femaleCount;
                    $undefinedReptileList[] = $undefinedCount;
                }
                $minCreatedAt->addMonth();
            }
        }

        return view('dashboard', compact('eggs', 'graphCategories', 'allReptileList', 'maleReptileList', 'femaleReptileList', 'undefinedReptileList'));
    }
}
