<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatingRequest;
use App\Models\Egg;
use App\Models\Mating;
use App\Models\Reptile;
use App\Models\Type;
use App\Repositories\EggRepositoryInterface;
use App\Repositories\Eloquent\ReptileRepository;
use App\Repositories\MatingRepositoryInterface;
use App\Repositories\ReptileRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatingController extends Controller
{
    private TypeRepositoryInterface $typeRepository;
    private ReptileRepositoryInterface $reptileRepository;
    private MatingRepositoryInterface $matingRepository;
    private EggRepositoryInterface $eggRepository;

    public function __construct(
        TypeRepositoryInterface    $typeRepository,
        ReptileRepositoryInterface $reptileRepository,
        MatingRepositoryInterface  $matingRepository,
        EggRepositoryInterface     $eggRepository
    )
    {
        $this->typeRepository = $typeRepository;
        $this->reptileRepository = $reptileRepository;
        $this->matingRepository = $matingRepository;
        $this->eggRepository = $eggRepository;
        parent::__construct('mating');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $request->input('paginate', 10);
        $fatherName = $request->input('father_name', null);
        $matherName = $request->input('mather_name', null);
        $matingAt = $request->input('mating_at', null);

        $list = $this->matingRepository->list([
            'f_reptile.name' => "%$fatherName%",
            'm_reptile.name' => "%$matherName%",
            'mating_at' => $matingAt,
        ], $paginate);

        return view("$this->path.list", compact("list"));
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

        return view($this->path.".create", compact('typeList', 'maleReptilePluck', 'femaleReptilePluck'));
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
        $this->matingRepository->create($validated);

        return redirect(route('mating.index'))->with('message', '메이팅을 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mating $mating)
    {
        $typeName = $this->typeRepository->getOne($mating['type_id'])['name'];
        $fatherName = $this->reptileRepository->getOne($mating['father_id'])['name'] ?? '미확인';
        $matherName = $this->reptileRepository->getOne($mating['mather_id'])['name'] ?? '미확인';

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
        $typeList = $this->typeRepository->getTypePluck();
        $femaleReptilePluck = $this->reptileRepository->getFemaleReptilePluck();
        $maleReptilePluck = $this->reptileRepository->getMaleReptilePluck();

        return view("$this->path.edit", compact('mating', 'typeList', 'femaleReptilePluck',  'maleReptilePluck'));
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
        $this->matingRepository->update($id, $validated);

        return redirect()->route('mating.show', $id)->with('message', '메이팅 정보를 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (empty($this->eggRepository->belongMating($id))) {
            $this->eggRepository->delete($id);
            return redirect()->route('mating.index')->with('message', '해당 정보를 삭제했습니다.');
        } else {
            return redirect()->route('mating.show', $id)
                ->with('message', '삭제할 수 없습니다, 해당 정보를 사용한 메이팅 정보가 존재합니다.');
        }
    }
}
