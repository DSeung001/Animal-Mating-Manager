<?php

namespace App\Http\Livewire;

use App\Models\Reptile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReptileSearchList extends Component
{
    // 뷰 property
    public $typeList, $maleReptilePluck, $femaleReptilePluck, $isDefault = false;
    // 컴포넌트 property
    public  $typeId, $fatherSearchString, $matherSearchString;
    // 추가 property
    public $typeSelected, $fatherSelected, $matherSelected;

    public function typeChange($typeId){
        if(isset($typeId)){
            $this->typeId = $typeId;
            $this->typeSelected = $typeId;
        }
        $this->maleReptilePluck = $this->setReptileList('m', $this->fatherSearchString);
        $this->femaleReptilePluck = $this->setReptileList('f', $this->matherSearchString);
    }

    public function fatherSearch($searchString){
        $this->fatherSearchString = $searchString;
        $this->maleReptilePluck = $this->setReptileList('m', $searchString);
    }

    public function matherSearch($searchString){
        $this->matherSearchString = $searchString;
        $this->femaleReptilePluck = $this->setReptileList('f', $searchString);
    }

    private function setReptileList($gender, $searchString = ""){
        $list = Reptile::select('id', 'name');

        if (!empty($this->typeId)) {
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
