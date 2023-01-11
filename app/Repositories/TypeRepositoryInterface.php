<?php
namespace App\Repositories;

interface TypeRepositoryInterface extends BaseRepositoryInterface{

    /**
     * @param $condition 조건
     * @param $pagination 페이지네이션
     * @return mixed ['count', 'length']
     */
    public function list($condition = [], $pagination = 10);

    /**
     * type id, name을 pluck 형태로 추출
     * @return mixed
     */
    public function getTypePluck();
}
