<?php

namespace App\Http\Livewire;

use App\Models\Mating;
use App\Models\Reptile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MatingSearch extends Component
{
    // 뷰 property
    public $typeList, $fatherReptileList, $matherReptileList, $matingList;
    // 컴포넌트 property
    public $matherId, $fatherId;

    public function fatherSearch($search){
        $this->fatherReptileList = $this->setReptileList('m', $search);
    }

    public function matherSearch($search){
        $this->matherReptileList = $this->setReptileList('f', $search);
    }

    private function setReptileList($gender, $search = ""){
        return  Reptile::select('id', 'name')
            ->searchByName($search)
            ->listByUserId(Auth::id())
            ->conditionGender($gender)
            ->pluck('name', 'id');
    }

    public function fatherSelect($id = null){
        $this->fatherId = $id;
        $this->setMatingList();
    }

    public function matherSelect($id = null){
        $this->matherId = $id;
        $this->setMatingList();
    }

    private function setMatingList(){

        $this->matingList = Mating::select(
            DB::raw("
                matings.id AS id,
                f_reptile.name AS father_name,
                m_reptile.name AS mather_name,
                comment,
                mating_at,
                matings.created_at AS created_at,
                matings.updated_at AS updated_at
            "))
            ->leftJoin('reptiles AS f_reptile', 'matings.father_id', '=', 'f_reptile.id')
            ->leftJoin('reptiles AS m_reptile', 'matings.mather_id', '=', 'm_reptile.id')
            ->where('matings.user_id', Auth::id());

        if (isset($this->fatherId)){
            $this->matingList = $this->matingList->where('matings.father_id', '=', $this->fatherId);

            \Log::info("setMatingList f : $this->fatherId");
        }

        if (isset($this->matherId)){
            $this->matingList = $this->matingList->where('matings.mather_id', '=', $this->matherId);

            \Log::info("setMatingList m : $this->matherId");
        }

        $this->matingList = $this->matingList->get();
    }

    public function render()
    {
        return view('livewire.mating-search');
    }
}
