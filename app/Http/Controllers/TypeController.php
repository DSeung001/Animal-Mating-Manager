<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Models\Type;
use App\Repositories\ReptileRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    private TypeRepositoryInterface $typeRepository;
    private ReptileRepositoryInterface $reptileRepository;

    public function __construct(
        TypeRepositoryInterface $typeRepository,
        ReptileRepositoryInterface $reptileRepository)
    {
        $this->typeRepository = $typeRepository;
        $this->reptileRepository = $reptileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->input('name', null);
        $paginate = $request->input('paginate', 10);

        $items = $this->typeRepository->list([
            'name' => $name
        ], $paginate);

        $listLength = $items['length'];
        $list = $items['list'];

        return view("front.type.list", compact("list", "listLength"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("front.type.create");
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
        $this->typeRepository->create($validated);

        return redirect(route('type.index'))->with('message', '종을 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view("front.type.show", compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view("front.type.edit", compact('type'));
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
        $this->typeRepository->update($id, [
            'name' => $validated['name'],
            'hatch_day' => $validated['hatch_day'],
            'comment' => $validated['comment']
        ]);
        return redirect()->route('type.show', $id)->with('message', '종을 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->reptileRepository->belongType($id)) {
            return redirect()->route('type.show', $id)
                ->with('message', '삭제할 수 없습니다, 해당 종에 개체가 존재합니다.');
        } else {
            $this->typeRepository->delete($id);
            return redirect()->route('type.index')
                ->with('message', '해당 정보를 삭제했습니다.');
        }
    }
}
