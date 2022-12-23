<?php
namespace App\Repositories;

interface MatingRepositoryInterface extends BaseRepositoryInterface{
    public function list($condition = [], $pagination = 10);

    /**
     * 메이팅 중에 해당 개체가 한 기록이 있는 지
     * @param $maleId
     * @param $femaleId
     * @return mixed
     */
    public function belongReptile($id);
}
