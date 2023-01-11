<?php
namespace App\Repositories;

interface MatingRepositoryInterface extends BaseRepositoryInterface{
    /**
     * @param $condition 조건
     * @param $pagination 페이지네이션
     * @return mixed ['count', 'length']
     */
    public function list($condition = [], $pagination = 10);

    /**
     * 메이팅 중에 해당 개체가 한 기록이 있는 지
     * @param $maleId
     * @param $femaleId
     * @return mixed
     */
    public function belongReptile($id);
}
