<?php
namespace App\Repositories;

interface TypeRepositoryInterface extends BaseRepositoryInterface{
    public function list($condition = [], $pagination = 10);

    /**
     * type id, name을 pluck 형태로 추출
     * @return mixed
     */
    public function getTypePluck();
}
