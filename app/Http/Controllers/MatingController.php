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

        $list = $this->mating
            ->select(
                DB::raw("
                matings.id AS id,
                f_reptile.name AS father_name,
                m_reptile.name AS mather_name,
                comment,
                mating_at,
                matings.created_at AS created_at,
                matings.updated_at AS updated_at
            "))
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->where('f_reptile.name', 'like', "%$fatherName%")
            ->where('m_reptile.name', 'like', "%$matherName%")
            ->where('matings.user_id', Auth::id())
            ->paginate($paginate);

        return view("$this->path.index", compact("list"));
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
