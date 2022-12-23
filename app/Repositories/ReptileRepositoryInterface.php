<?php
namespace App\Repositories;

interface ReptileRepositoryInterface extends BaseRepositoryInterface{
    public function list($condition = [], $pagination = 10);

    /**
     * 전체 개체 중에서 해당 타입을 가진 개체가 있는 지
     * @param $typeId
     * @return bool
     */
    public function belongType($typeId);

    /**
     * 수컷 개체들의 id, name을 pluck 형태로 추출
     * @param $typeId
     * @return mixed
     */
    public function getMaleReptilePluck($typeId = null);

    /**
     * 암컷 개체들의 id, name을 pluck 형태로 추출
     * @param $typeId
     * @return mixed
     */
    public function getFemaleReptilePluck($typeId = null);

    /**
     * 테이블에 값이 존재하는 지 체크
     * @return bool
     */
    public function dataExists();

    /**
     * created_at 최대 값 가져오기
     * @return mixed
     */
    public function getMaxCreatedAt();

    /**
     * created_at 최소 값 가져오기
     * @return mixed
     */
    public function getMinCreatedAt();

    /**
     * 달을 기준으로 카운팅
     * @return mixed
     */
    public function getCountByCreatedAt($createdAt);

    /**
     * type chart 에서 사용할 데이터 리스트
     * @return mixed
     */
    public function getTypeChartList();
}
