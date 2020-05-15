<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\GoalRepository;
use App\Task;
use Illuminate\Http\Request;
use App\Notifications\GoalNotification;
class TaskController extends Controller
{

    public function __construct(GoalRepository $goal)
    {
        $this->goal = $goal;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        try{
            $task = \Auth::user()->goals()
                ->where('id', $request->input('goal_id'))->first()
                ->tasks()->where('id', $id)->first();
//            $task = Task::where([
//                ['goal_id', '=', $request->input('goal_id')],
//                ['id', '=', $id]
//            ])->first();

            $currentPgs = $task->progress;

            $task->update($request->all());

            $goal = $this->goal->calProgress($request->input('goal_id'));
            $this->currentUser()->notify(new GoalNotification($task, ['currentPgs' => $currentPgs]));
        } catch (\Exception $e){
            return $this->jsonError(500, $e->getMessage());
        }

        return $this->jsonSuccess([
            'message' => 'Cập nhật thành công',
            'goal' => $goal,
            'statusMain' => $goal->pgrStatus()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $task = Task::findOrFail($id);
            $goal_id = $task->goal_id;
            $task->delete();
            $goal = $this->goal->calProgress($goal_id);
        } catch (\Exception $e){
            return $this->jsonError(500, $e->getMessage());
        }


        return $this->jsonSuccess([
            'message' => 'Xóa thành công',
            'goal' => $goal,
            'statusMain' => $goal->pgrStatus()
        ]);
    }
}
