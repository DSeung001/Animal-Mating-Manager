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
    public function index()
    {
        // 부모 아이디로 링크 추가하기
        $list = $this->reptile
            ->select(
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
            ->where('reptiles.user_id', Auth::id())->get();

        return view("$this->path.index", compact("list"));
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
            'birth' => $request->input('birth')
        ]);

        return redirect(route('dashboard'))->with('status', '개체를 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
