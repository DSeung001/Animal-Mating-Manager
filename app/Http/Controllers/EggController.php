<?php

namespace App\Http\Controllers;

use App\Http\Requests\EggRequest;
use App\Models\Egg;
use App\Models\Mating;
use App\Models\Reptile;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $list = $this->egg
            ->where('user_id', Auth::id())->get();

        return view("$this->path.index", compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $typeList = $this->type->getTypePluck();
        $matherReptileList = $this->reptile->getFemaleReptilePluck();
        $fatherReptileList = $this->reptile->getMaleReptilePluck();

        return view($this->path.'.create',
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

        return redirect(route('dashboard'))->with('status', '알을 등록했습니다.');
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
