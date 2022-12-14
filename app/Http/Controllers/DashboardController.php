<?php

namespace App\Http\Controllers;

use App\Models\Egg;
use App\Models\Mating;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private Egg $egg;
    private Mating $mating;

    public function __construct(Egg $egg, Mating $mating){
        $this->egg = $egg;
        $this->mating = $mating;
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

        return view('dashboard', compact('eggs'));
    }
}
