<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    private Type $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
        parent::__construct('type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->input('name', '');
        $paginate = $request->input('paginate', 10);

        $list = $this->type
            ->select('id', 'name', 'hatch_day', 'created_at', 'updated_at')
            ->where('user_id', Auth::id())
            ->searchByName($name)
            ->setPaginate($paginate);
        return view("$this->path.list", compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("$this->path.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['comment'] = $request->input('comment');
        $this->type->create($validated);

        return redirect(route('type.index'))->with('status', '종을 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view("$this->path.show", compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view("$this->path.edit", compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TypeRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, $id)
    {
        $validated = $request->validated();
        $this->type
            ->where('id', $id)
            ->update([
            'name' => $validated['name'],
            'hatch_day' => $validated['hatch_day'],
            'comment' => $request['comment']
        ]);
        return redirect()->route('type.show', $id)->with('status', '종을 수정했습니다.');
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
