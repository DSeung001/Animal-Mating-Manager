<?php
namespace App\Repositories;

interface EggRepositoryInterface extends BaseRepositoryInterface{
    /**
     * @param $condition 조건
     * @param $pagination 페이지네이션
     * @return mixed ['count', 'length']
     */
    public function list($condition = [], $pagination = 10);

    /**
     * 전체 알 중에서 해당 메이팅에 포함된 알이 있는 지
     * @param $matingId
     * @return mixed
     */
    public function belongMating($matingId);

    /**
     * 부화 예정일 리스트 가져오기
     * @return mixed
     */
    public function getHatchingScheduled();
}
