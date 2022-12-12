<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatingRequest;
use App\Models\Mating;
use App\Models\Reptile;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatingController extends Controller
{
    private Mating $mating;
    private Reptile $reptile;
    private Type $type;

    public function __construct(Mating $maitng, Reptile $reptile, Type $type)
    {
        $this->mating = $maitng;
        $this->reptile = $reptile;
        $this->type = $type;
        parent::__construct('mating');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->input('paniate', 10);
        $fatherName = $request->input('father_name', '');
        $matherName = $request->input('mather_name', '');
        $matingAt = $request->input('mating_at',null);

        $list = $this->mating
            ->select(
                'matings.id as id',
                DB::raw("
                matings.id AS id,
                f_reptile.name AS father_name,
                m_reptile.name AS mather_name,
                matings.comment,
                mating_at,
                matings.created_at AS created_at,
                matings.updated_at AS updated_at
            "))
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->where('f_reptile.name', 'like', "%$fatherName%")
            ->where('m_reptile.name', 'like', "%$matherName%")
            ->where('matings.user_id', Auth::id());

        if (isset($matingAt)) {
            $list = $list->where('mating_at', $matingAt);
        }
        $list = $list->paginate($paginate);

        return view("$this->path.list", compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeList = $this->type->getTypePluck();
        $matherReptileList = $this->reptile->getFemaleReptilePluck();
        $fatherReptileList = $this->reptile->getMaleReptilePluck();

        return view($this->path.".create", compact('typeList', 'fatherReptileList', 'matherReptileList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MatingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatingRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['comment'] = $request->input('comment');
        $this->mating->create($validated);

        return redirect(route('mating.index'))->with('status', '메이팅을 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mating $mating)
    {
        $typeName = $this->type->where('id', $mating['type_id'])->first()['name'];
        $fatherName = $this->reptile->where('id', $mating['father_id'])->first()['name'] ?? '미확인';
        $matherName = $this->reptile->where('id', $mating['mather_id'])->first()['name'] ?? '미확인';

        return view("$this->path.show", compact('mating', 'typeName', 'fatherName', 'matherName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mating $mating)
    {
        $typeList = $this->type->getTypePluck();
        $matherReptileList = $this->reptile->getFemaleReptilePluck();
        $fatherReptileList = $this->reptile->getMaleReptilePluck();

        return view("$this->path.edit", compact('mating', 'typeList', 'matherReptileList',  'fatherReptileList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MatingRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatingRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['comment'] = $request->input('comment');
        $this->mating
            ->where('id', $this)
            ->where('user_id', Auth::id())
            ->update($validated);

        return redirect()->route('mating.show', $id)->with('status', '메이팅 정보를 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
