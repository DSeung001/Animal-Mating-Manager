<?php

namespace App\Http\Controllers;

use App\Models\BlockReptileHistory;
use App\Models\Egg;
use App\Models\Mating;
use App\Models\Reptile;
use App\Repositories\BlockReptileHistoryRepositoryInterface;
use App\Repositories\EggRepositoryInterface;
use App\Repositories\ReptileRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private ReptileRepositoryInterface $reptileRepository;
    private EggRepositoryInterface $eggRepository;
    private BlockReptileHistoryRepositoryInterface $blockReptileHistoryRepository;

    public function __construct(
        EggRepositoryInterface $eggRepository,
        ReptileRepositoryInterface $reptileRepository,
        BlockReptileHistoryRepositoryInterface $blockReptileHistoryRepository
    ){
        $this->eggRepository = $eggRepository;
        $this->reptileRepository = $reptileRepository;
        $this->blockReptileHistoryRepository = $blockReptileHistoryRepository;
    }

    public function dashboard()
    {
        /* 부화 예상일 */
        $hatchingScheduled = $this->eggRepository->getHatchingScheduled();
        /* 종류 분포도 */
        $typeChart = $this->reptileRepository->getTypeChartList();

        /* 개체수 그래프 */
        $allReptileChartCategories = [];
        $allReptileChart = [];

        if($this->reptileRepository->dataExists()){
            $maxCreatedAt = Carbon::parse($this->reptileRepository->getMaxCreatedAt());
            $minCreatedAt = Carbon::parse($this->reptileRepository->getMinCreatedAt());
            $diffMonth = $minCreatedAt->diffInMonths($maxCreatedAt)+1;
            $currentCreatedAt = $minCreatedAt;

            for($re = 0 ; $re < $diffMonth ; $re++){
                $allReptileChartCategories[] = $minCreatedAt->format('Y.m');
                $allCount = $this->reptileRepository->getCountByCreatedAt($currentCreatedAt);
                    - $this->blockReptileHistoryRepository->getCountByCreatedAt($currentCreatedAt);
                if($re > 0){
                    $allReptileChart[] = $allReptileChart[$re-1] + $allCount;
                } else {
                    $allReptileChart[] = $allCount;
                }
                $currentCreatedAt->addMonth();
            }
        }

        return view('dashboard', compact('hatchingScheduled', 'allReptileChartCategories', 'allReptileChart', 'typeChart'));
    }
}
