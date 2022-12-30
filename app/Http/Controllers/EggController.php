<?php

namespace App\Http\Controllers;

use App\Http\Requests\EggRequest;
use App\Models\Egg;
use App\Repositories\EggRepositoryInterface;
use App\Repositories\MatingRepositoryInterface;
use App\Repositories\ReptileRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class EggController extends Controller
{
    private TypeRepositoryInterface $typeRepository;
    private ReptileRepositoryInterface $reptileRepository;
    private MatingRepositoryInterface $matingRepository;
    private EggRepositoryInterface $eggRepository;

    public function __construct(
        TypeRepositoryInterface $typeRepository,
        ReptileRepositoryInterface $reptileRepository,
        MatingRepositoryInterface $matingRepository,
        EggRepositoryInterface $eggRepository,
    )
    {
        $this->typeRepository = $typeRepository;
        $this->reptileRepository = $reptileRepository;
        $this->matingRepository = $matingRepository;
        $this->eggRepository = $eggRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typeList = $this->typeRepository->getTypePluck();

        $paginate = $request->input('paginate', 10);
        $spawnAt = $request->input('spawn_at', null);
        $hatching = $request->input('hatching', null);
        $type = $request->input('type', null);

        $list = $this->eggRepository->list([
                'spawn_at' => $spawnAt,
                'is_hatching' => $hatching,
                'eggs.type_id' => $type
            ], $paginate);

        return view("front.egg.list", compact('list', 'typeList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeList = $this->typeRepository->getTypePluck();
        $femaleReptilePluck = $this->reptileRepository->getFemaleReptilePluck();
        $maleReptilePluck = $this->reptileRepository->getMaleReptilePluck();

        return view("front.egg.create",
            compact('typeList', 'femaleReptilePluck', 'maleReptilePluck')
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
        $this->eggRepository->create($validated);

        return redirect(route('egg.index'))->with('message', '알을 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $egg = $this->eggRepository->getOne($id);
        $mating = $this->matingRepository->getOne($egg['mating_id']);
        $typeName = $this->typeRepository->getOne($egg['type_id'])['name'];
        $matherName = $this->reptileRepository->getOne($mating['mather_id'])['name'] ?? '미확인';
        $fatherName = $this->reptileRepository->getOne($mating['father_id'])['name'] ?? '미확인';

        return view("front.egg.show", compact('egg', 'typeName', 'fatherName', 'matherName', 'mating'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Egg $egg)
    {
        $typeList = $this->typeRepository->getTypePluck();
        $femaleReptilePluck = $this->reptileRepository->getFemaleReptilePluck();
        $maleReptilePluck = $this->reptileRepository->getMaleReptilePluck();

        $matingList = $this->matingRepository->list([
            'matings.id' => $egg['mating_id']
        ], 'all');

        return view("front.egg.edit", compact('egg', 'typeList', 'maleReptilePluck', 'femaleReptilePluck', 'matingList'));
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
        $this->eggRepository->update($id, $validated);

        return redirect()->route('egg.show', $id)->with('message', '알 정보를 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->eggRepository->delete($id);
        return redirect()->route('egg.index')->with('message', '해당 정보를 삭제했습니다.');
    }
}
