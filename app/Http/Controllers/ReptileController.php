<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReptileRequest;
use App\Models\Mating;
use App\Models\Reptile;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReptileController extends Controller
{
    private Reptile $reptile;
    private Mating $mating;
    private Type $type;

    public function __construct(Reptile $reptile, Mating $mating, Type $type)
    {
        $this->reptile = $reptile;
        $this->mating = $mating;
        $this->type = $type;
        parent::__construct('reptile');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->input('name', '');
        $type = $request->input('type', null);
        $morph = $request->input('morph', '');
        $paginate = $request->input('paniate', 10);

        // 부모 아이디로 링크 추가하기
        $list = $this->reptile
            ->select(
                'reptiles.id as id',
                DB::raw("
                reptiles.id AS id,
                reptiles.name AS name,
                reptiles.morph AS morph,
                types.name AS type,
                reptiles.gender AS gender,
                reptiles.status AS status,
                reptiles.father_id AS father_id,
                reptiles.mather_id AS mather_id,
                reptiles.birth AS birth,
                f_reptile.name AS father_name,
                m_reptile.name AS mather_name,
                TIMESTAMPDIFF(MONTH, reptiles.birth, now()) AS age
                "))
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'reptiles.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'reptiles.mather_id')
            ->leftJoin('types', 'types.id', '=', 'reptiles.type_id')
            ->where('reptiles.user_id', Auth::id())
            ->where('reptiles.name', 'like', "%$name%")
            ->where('reptiles.morph', 'like', "%$morph%");

        if (isset($type)) {
            $list = $list->where('reptiles.type_id', $type);
        }

        $list = $list->setPaginate($paginate);

        $typeList = $this->type->getTypePluck();

        return view("$this->path.list", compact("list", "typeList"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        $typeList = $this->type->listByUserId($userId)->pluck('name', 'id');
        $fatherReptileList = $this->reptile->listByUserId($userId)->conditionGender('m')->pluck('name', 'id');
        $matherReptileList = $this->reptile->listByUserId($userId)->conditionGender('f')->pluck('name', 'id');

        return view($this->path . ".create", compact('typeList', 'fatherReptileList', 'matherReptileList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReptileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReptileRequest $request)
    {
        $validated = $request->validated();

        $this->reptile->create([
            'user_id' => Auth::id(),
            'type_id' => $validated['type_id'],
            'father_id' => $request->input('father_id'),
            'mather_id' => $request->input('mather_id'),
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'status' => $validated['status'],
            'morph' => $validated['morph'],
            'birth' => $request->input('birth'),
            'comment' => $request->input('comment')
        ]);

        return redirect(route('reptile.index'))->with('message', '개체를 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param Reptile $reptile
     * @return \Illuminate\Http\Response
     */
    public function show(Reptile $reptile)
    {
        $typeName = $this->type->where('id', $reptile['type_id'])->first()['name'];
        $fatherName = $this->reptile->where('id', $reptile['father_id'])->first()['name'] ?? '미확인';
        $matherName = $this->reptile->where('id', $reptile['mather_id'])->first()['name'] ?? '미확인';

        return view("$this->path.show",
            compact('reptile', 'typeName', 'fatherName', 'matherName')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reptile $reptile
     * @return \Illuminate\Http\Response
     */
    public function edit(Reptile $reptile)
    {
        $userId = Auth::id();
        $typeList = $this->type->listByUserId($userId)->pluck('name', 'id');
        $fatherReptileList = $this->reptile
            ->listByUserId($userId)
            ->conditionGender('m')
            ->where('type_id', $reptile['type_id'])
            ->pluck('name', 'id');
        $matherReptileList = $this->reptile
            ->listByUserId($userId)
            ->conditionGender('f')
            ->where('type_id', $reptile['type_id'])
            ->pluck('name', 'id');

        $reptileKey= $this->reptile
            ->select('gender as gender_key', 'status as status_key')
            ->where('id', $reptile->id)->first();

        $genderKey = $reptileKey ['gender_key'];
        $statusKey =  $reptileKey ['status_key'];

        return view("$this->path.edit",
            compact('typeList', 'fatherReptileList', 'matherReptileList', 'reptile', 'genderKey', 'statusKey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReptileRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReptileRequest $request, $id)
    {
        $validated = $request->validated();

        $this->reptile
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->update([
                'type_id' => $validated['type_id'],
                'father_id' => $request->input('father_id'),
                'mather_id' => $request->input('mather_id'),
                'name' => $validated['name'],
                'gender' => $validated['gender'],
                'status' => $validated['status'],
                'morph' => $validated['morph'],
                'birth' => $request->input('birth'),
                'comment' => $request->input('comment')
            ]);

        /*
         * 여기서 reptile 히스토리를 저장하고 그 데이터를 통해 그래프에 반영
         * 1. 성별 수정
         * 2. 상태 수정
         * => 공통점 : 데이터 변경된 날 기준으로 데이터들의 증감이 일어남
         *
         * 1차 방법
         * 테이블 재수정
         * id/user_id/reptile_id/created_at/column/type/number 이렇게?
         * ex)
         * 성별을 u -> m으로 수정하면 아래와 같이 데이터가 생성
         * 1/1/2022.12/gender/m/1
         * 2/1/2022.12/gender/u/-1
         *
         * 그래프에서 정보들을 다 가져오고 계산식에 적용만 하면 됨
         *
         * => 큰 단점 : 이 방벙은 무결성이 지켜지지 않음
         * 단 지금과 같은 상황에서 사용가능할까?
         * */

        /*
         * 1. 성별 바뀐지 체크
         *  => history
         * 2. 상태 바뀐지 체크
         *  => history
         * */


        return redirect()->route('reptile.show', $id)->with('message', '개체 정보를 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($this->mating->where('father_id', $id)->first()) || !empty($this->mating->where('mather_id', $id)->first()) ){
            return redirect()->route('reptile.show', $id)->with('message', '삭제할 수 없습니다, 해당 정보를 사용한 메이팅 정보가 존재합니다.');
        } else{
            $this->reptile->where('id', $id)->delete();
            return redirect()->route('reptile.index')->with('message', '해당 정보를 삭제했습니다.');
        }
    }
}
