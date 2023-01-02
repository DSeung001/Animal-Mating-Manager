<?php

namespace App\Repositories;

interface TodoRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 해당 날짜에 해야하는 할 일을 가져옵니다.
     * @param $date date yyyy-mm-dd 형식
     * @return mixed
     */
    public function list($date);
}
