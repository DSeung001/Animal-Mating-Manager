<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReptileRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\Reptile;
use App\Repositories\BlockReptileHistoryRepositoryInterface;
use App\Repositories\MatingRepositoryInterface;
use App\Repositories\ReptileImageRepositoryInterface;
use App\Repositories\ReptileRepositoryInterface;
use App\Repositories\TypeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReptileController extends Controller
{
    use UploadImageTrait;

    private TypeRepositoryInterface $typeRepository;
    private ReptileRepositoryInterface $reptileRepository;
    private MatingRepositoryInterface $matingRepository;
    private BlockReptileHistoryRepositoryInterface $blockReptileHistoryRepository;
    private ReptileImageRepositoryInterface $reptileImageRepository;

    public function __construct (
        TypeRepositoryInterface                $typeRepository,
        ReptileRepositoryInterface             $reptileRepository,
        MatingRepositoryInterface              $matingRepository,
        BlockReptileHistoryRepositoryInterface $blockReptileHistoryRepository,
        ReptileImageRepositoryInterface        $reptileImageRepository
    )
    {
        $this->typeRepository = $typeRepository;
        $this->reptileRepository = $reptileRepository;
        $this->matingRepository = $matingRepository;
        $this->blockReptileHistoryRepository = $blockReptileHistoryRepository;
        $this->reptileImageRepository = $reptileImageRepository;
        parent::__construct('reptile');
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
        $name = $request->input('name', null);
        $type = $request->input('type', null);
        $morph = $request->input('morph', null);

        // 부모 아이디로 링크 추가하기
        $list = $this->reptileRepository
            ->list([
                'reptiles.name' => "%$name%",
                'reptiles.morph' => "%$morph%",
                'reptiles.type_id' => $type
            ], $paginate);

        return view("$this->path.list", compact("list", "typeList"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeList = $this->typeRepository->getTypePluck();
        $maleReptilePluck = $this->reptileRepository->getMaleReptilePluck();
        $femaleReptilePluck = $this->reptileRepository->getFemaleReptilePluck();

        return view($this->path . ".create", compact('typeList', 'maleReptilePluck', 'femaleReptilePluck'));
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
        $image = $validated['reptile_image'];

        $reptile = $this->reptileRepository->create([
            'user_id' => Auth::id(),
            'type_id' => $validated['type_id'],
            'father_id' => $request->input('father_id'),
            'mather_id' => $request->input('mather_id'),
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'status' => $validated['status'],
            'morph' => $validated['morph'],
            'birth' => $request->input('birth'),
            'comment' => $request->input('comment')
        ]);

        if (isset($image)) {
            $this->reptileImageRepository->create([
                'reptile_id' => $reptile['id'],
                'path' => $this->uploadImage($image)
            ]);
        }

        return redirect(route('reptile.index'))->with('message', '개체를 등록했습니다.');
    }

    /**
     * Display the specified resource.
     *
     * @param Reptile $reptile
     * @return \Illuminate\Http\Response
     */
    public function show(Reptile $reptile)
    {
        $typeName = $this->typeRepository->getOne($reptile['type_id'])['name'];
        $fatherName = $this->reptileRepository->getOne($reptile['father_id'])['name'] ?? '미확인';
        $matherName = $this->reptileRepository->getOne($reptile['mather_id'])['name'] ?? '미확인';
        $image = $this->reptileImageRepository->getOne($reptile['id']);

        return view("$this->path.show",
            compact('reptile', 'typeName', 'fatherName', 'matherName', 'image')
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
        $typeList = $this->typeRepository->getTypePluck();
        $maleReptilePluck = $this->reptileRepository->getMaleReptilePluck($reptile['type_id']);
        $femaleReptilePluck = $this->reptileRepository->getFemaleReptilePluck($reptile['type_id']);
        $image = $this->reptileImageRepository->getOne($reptile['id']);

        $reptileKey = $this->reptileRepository->getOne($reptile['id'], 'gender as gender_key, status as status_key');
        $genderKey = $reptileKey ['gender_key'];
        $statusKey = $reptileKey ['status_key'];

        return view("$this->path.edit",
            compact('typeList', 'maleReptilePluck', 'femaleReptilePluck', 'reptile', 'genderKey', 'statusKey', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReptileRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReptileRequest $request, $id)
    {
        $validated = $request->validated();
        $oldReptileImage = $this->reptileImageRepository->getOne($id);

        if ($request->input('modified', 'false') === 'true') {
            $image = $validated['reptile_image'];
            if (isset($image)) {
                if (isset($oldReptileImage)) {
                    $this->deleteImage($oldReptileImage->path);
                    $this->reptileImageRepository->update($id, [
                        'path' => $this->uploadImage($image)
                    ]);
                } else {
                    $this->reptileImageRepository->update($id, [
                        'reptile_id' => $id,
                        'path' => $this->uploadImage($image)
                    ]);
                }
            } else {
                if (isset($oldReptileImage)) {
                    $this->deleteImage($oldReptileImage->path);
                }
                $this->reptileImageRepository->delete($id);
            }
        }

        $userId = Auth::id();
        $oldReptile = $this->reptileRepository->getOne($id, 'status as status_key');

        if (($oldReptile['status_key'] === 'd' || $oldReptile['status_key'] === 's') &&
            ($validated['status'] !== 'd' && $validated['status'] !== 's')) {
            $this->blockReptileHistoryRepository->delete($id);
        } else if (
            ($oldReptile['status_key'] !== 'd' && $oldReptile['status_key'] !== 's') &&
            ($validated['status'] === 'd' || $validated['status'] === 's')
        ) {
            $this->blockReptileHistoryRepository->create([
                'user_id' => $userId,
                'reptile_id' => $id
            ]);
        }

        $this->reptileRepository->update($id,
            [
                'type_id' => $validated['type_id'],
                'father_id' => $request->input('father_id'),
                'mather_id' => $request->input('mather_id'),
                'name' => $validated['name'],
                'gender' => $validated['gender'],
                'status' => $validated['status'],
                'morph' => $validated['morph'],
                'birth' => $request->input('birth'),
                'comment' => $request->input('comment')
            ]
        );

        return redirect()->route('reptile.show', $id)->with('message', '개체 정보를 수정했습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->matingRepository->belongReptile($id)) {
            return redirect()->route('reptile.show', $id)->with('message', '삭제할 수 없습니다, 해당 개체가 한 메이팅 정보가 존재합니다.');
        } else {
            $this->reptileRepository->delete($id);
            return redirect()->route('reptile.index')->with('message', '해당 정보를 삭제했습니다.');
        }
    }
}
