<?php

namespace App\Http\Controllers;

use App\Models\BlockReptileHistory;
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
    private BlockReptileHistory $blockReptileHistory;

    public function __construct(Egg $egg, Reptile $reptile, BlockReptileHistory $blockReptileHistory){
        $this->egg = $egg;
        $this->reptile = $reptile;
        $this->blockReptileHistory = $blockReptileHistory;
    }

    public function dashboard()
    {
        $userId = Auth::id();

        /* 부화 예상일 */
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
            ->where('eggs.user_id', $userId)
            ->get()
            ->toArray();
        $eggs = array_map(function ($egg){
           return [
               'title' => $egg['father_name']."x".$egg['mather_name']." 알",
               'url' => route('egg.show',$egg['id']),
               'start' => $egg['start']
           ];
        }, $eggs);

        /* 개체수 그래프*/
        $allReptileChartCategories = [];
        $allReptileChart = [];

        if($this->reptile->where('id', '!=', '0')->first() !== null){
            $maxCreatedAt = Carbon::parse($this->reptile
                ->select(DB::raw('max(created_at) as created_at'))
                ->where('user_id', $userId)
                ->first()['created_at']);
            $minCreatedAt = Carbon::parse($this->reptile
                ->select(DB::raw('min(created_at) as created_at'))
                ->where('user_id', $userId)
                ->first()['created_at']);
            $diffMonth = $minCreatedAt->diffInMonths($maxCreatedAt)+1;

            for($re = 0 ; $re < $diffMonth ; $re++){
                $allReptileChartCategories[] = $minCreatedAt->format('Y.m');

                $allCount = $this->reptile
                        ->select(DB::raw('count(id) as count'))
                        ->where('user_id', $userId)
                        ->where('created_at', 'like', $minCreatedAt->format('Y-m')."%")
                        ->first()['count']
                    -
                    $this->blockReptileHistory
                        ->select(DB::raw('count(id) as count'))
                        ->where('user_id', $userId)
                        ->where('created_at', 'like', $minCreatedAt->format('Y-m')."%")
                        ->first()['count'];

                if($re > 0){
                    $allReptileChart[] = $allReptileChart[$re-1] + $allCount;
                } else {
                    $allReptileChart[] = $allCount;
                }
                $minCreatedAt->addMonth();
            }
        }

        /* 종류 분포도 */
        $typeChart = $this->reptile
            ->select('types.name as name', 'types.name as drilldown', DB::raw('count(types.id) as y'))
            ->leftJoin('types', 'types.id', '=', 'type_id')
            ->where('reptiles.user_id', $userId)
            ->where('status', '!=', 'd')
            ->where('status', '!=', 's')
            ->groupBy('types.id')
            ->get();


        return view('dashboard', compact('eggs', 'allReptileChartCategories', 'allReptileChart', 'typeChart'));
    }
}
