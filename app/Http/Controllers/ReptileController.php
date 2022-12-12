<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReptileRequest;
use App\Models\Reptile;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReptileController extends Controller
{
    private Reptile $reptile;
    private Type $type;

    public function __construct(Reptile $reptile, Type $type)
    {
        $this->reptile = $reptile;
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
            'morph' => $validated['morph'],
            'birth' => $request->input('birth'),
            'comment' => $request->input('comment')
        ]);

        return redirect(route('reptile.index'))->with('status', '개체를 등록했습니다.');
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

        $genderKey = $this->reptile->select('gender as gender_key')->where('id', $reptile->id)->first()['gender_key'];
        return view("$this->path.edit",
            compact('typeList', 'fatherReptileList', 'matherReptileList', 'reptile', 'genderKey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReptileRequest $request, Reptile $reptile)
    {
        $validated = $request->validated();

        $reptile
            ->where('id', $reptile['id'])
            ->where('user_id', Auth::id())
            ->update([
            'type_id' => $validated['type_id'],
            'father_id' => $request->input('father_id'),
            'mather_id' => $request->input('mather_id'),
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'morph' => $validated['morph'],
            'birth' => $request->input('birth'),
            'comment' => $request->input('comment')
        ]);

        return redirect()->route('reptile.show', $reptile)->with('status', '개체 정보를 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
