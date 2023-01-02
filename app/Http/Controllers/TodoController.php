<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Repositories\TodoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    private TodoRepositoryInterface $todoRepository;

    /**
     * @param TodoRepositoryInterface $todoRepository
     */
    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $now = $request->input('date', date('Y-m-d'));
        $prevDay = route('todo.index', ['date' => Carbon::createFromDate($now)->subDay()->format('Y-m-d')]);
        $nextDay = route('todo.index', ['date' => Carbon::createFromDate($now)->addDay()->format('Y-m-d')]);
        $list = $this->todoRepository->list($now);
        return view('front.todo.index', compact('list', 'now', 'prevDay', 'nextDay'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $this->todoRepository->create($validated);

        return redirect(route('todo.index'))->with('message', '할 일을 등록했습니다.');
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
     * @param Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return view("front.todo.edit", compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $validated = $request->validated();
        $this->todoRepository->update($id, $validated);
        return redirect()->route('todo.index', $id)->with('message', '할 일을 수정했습니다.');
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
