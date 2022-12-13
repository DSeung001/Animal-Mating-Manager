<?php

namespace App\Http\Controllers;

use App\Http\Requests\EggRequest;
use App\Models\Egg;
use App\Models\Mating;
use App\Models\Reptile;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EggController extends Controller
{
    private Egg $egg;
    private Type $type;
    private Reptile $reptile;
    private Mating $mating;

    public function __construct(Egg $egg, Type $type, Reptile $reptile, Mating $mating)
    {
        $this->egg = $egg;
        $this->type = $type;
        $this->reptile = $reptile;
        $this->mating = $mating;
        parent::__construct('egg');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typeList = $this->type->getTypePluck();
        $hatchingList = $this->egg->getHatchingPluck();

        $spawnAt = $request->input('spawn_at', null);
        $hatching = $request->input('hatching', null);
        $type = $request->input('type', null);
        $paginate = $request->input('paniate', 10);

        $list = $this->egg
            ->select(
                'eggs.id as id',
                'spawn_at',
                DB::raw("DATE_ADD(spawn_at, INTERVAL hatch_day DAY) as estimated_date"),
                'is_hatching',
                'types.name as type_name',
                'f_reptile.name as father_name',
                'm_reptile.name as mather_name'
            )
            ->leftJoin('types', 'types.id', '=', 'type_id')
            ->leftJoin('matings', 'matings.id', '=', 'mating_id')
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->where('eggs.user_id', Auth::id());

        if (isset($spawnAt)) {
            $list = $list->where('estimated_date', $spawnAt);
        }
        if (isset($hatching)) {
            $list = $list->where('is_hatching', $hatching);
        }
        if (isset($type)) {
            $list = $list->where('eggs.type_id', $type);
        }
        $list = $list->paginate($paginate);

        return view("$this->path.list", compact('list', 'typeList', 'hatchingList'));
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

        return view($this->path . '.create',
            compact('typeList', 'matherReptileList', 'fatherReptileList')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EggRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EggRequest $request)
    {
        $validated = $request->validated();
        $validated['comment'] = $request->input('comment');
        $validated['user_id'] = Auth::id();
        $this->egg->create($validated);

        return redirect(route('egg.index'))->with('status', '알을 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Egg $egg)
    {
        $typeName = $this->type->where('id', $egg['type_id'])->first()['name'];

        $fatherName = $this->reptile
            ->select('reptiles.name as name')
            ->join('matings', function ($join) use ($egg) {
                $join->on('matings.father_id', '=', 'reptiles.id')
                    ->where('matings.id', '=', $egg['mating_id']);
            })->first()['name'] ?? '미확인';

        $matherName = $this->reptile
            ->select('reptiles.name as name')
            ->join('matings', function ($join) use ($egg) {
                $join->on('matings.mather_id', '=', 'reptiles.id')
                    ->where('matings.id', '=', $egg['mating_id']);
            })->first()['name'] ?? '미확인';

        $mating = $this->mating->where('id', $egg['mating_id'])->first();

        return view("$this->path.show", compact('egg', 'typeName', 'fatherName', 'matherName', 'mating'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Egg $egg)
    {
        $typeList = $this->type->getTypePluck();
        $matherReptileList = $this->reptile->getFemaleReptilePluck();
        $fatherReptileList = $this->reptile->getMaleReptilePluck();

        $matingList = $this->mating
            ->select(
                'matings.id as id',
                'matings.type_id as type_id',
                DB::raw("
                f_reptile.name AS father_name,
                m_reptile.name AS mather_name"),
                'matings.comment as comment',
                'mating_at',
                'matings.father_id as father_id',
                'matings.mather_id as mather_id'
            )
            ->leftJoin('reptiles AS f_reptile', 'f_reptile.id', '=', 'matings.father_id')
            ->leftJoin('reptiles AS m_reptile', 'm_reptile.id', '=', 'matings.mather_id')
            ->where('matings.user_id', Auth::id())
            ->where('matings.id', $egg['mating_id'])
            ->get();

        return view("$this->path.edit", compact('egg', 'typeList', 'fatherReptileList', 'matherReptileList', 'matingList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EggRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EggRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['comment'] = $request->input('comment');
        $validated['is_hatching'] = $request->input('is_hatching');
        $this->egg
            ->where('id', $id)
            ->update($validated);

        return redirect()->route('egg.show', $id)->with('status', '알 정보를 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->egg->where('id', $id)->delete();
        return redirect()->route('egg.index')->with('status', '해당 정보를 삭제했습니다.');
    }
}
