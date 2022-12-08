<?php

namespace App\Http\Livewire;

use App\Models\Mating;
use App\Models\Reptile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReptileSearchList extends Component
{
    // 뷰 property
    public $typeList, $fatherReptileList, $matherReptileList, $isDefault = false;
    // 컴포넌트 property
    public  $typeId, $fatherSearchString, $matherSearchString;
    // 수정일 때 사용 property
    public $typeSelected, $fatherSelected, $matherSelected;

    public function typeChange($typeId){
        if(isset($typeId)){
            $this->typeId = $typeId;
        }
        $this->fatherReptileList = $this->setReptileList('m', $this->fatherSearchString);
        $this->matherReptileList = $this->setReptileList('f', $this->matherSearchString);
    }

    public function fatherSearch($searchString){
        $this->fatherSearchString = $searchString;
        $this->fatherReptileList = $this->setReptileList('m', $searchString);
    }

    public function matherSearch($searchString){
        $this->matherSearchString = $searchString;
        $this->matherReptileList = $this->setReptileList('f', $searchString);
    }

    private function setReptileList($gender, $searchString = ""){
        $list = Reptile::select('id', 'name');

        if (isset($this->typeId)) {
            $list = $list->where('type_id', $this->typeId);
        }

        return  $list->searchByName($searchString)
            ->listByUserId(Auth::id())
            ->conditionGender($gender)
            ->pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.reptile-search-list');
    }
}
