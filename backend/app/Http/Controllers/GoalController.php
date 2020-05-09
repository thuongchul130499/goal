<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalRequest;
use App\Goal;
use App\Notifications\GoalNotification;
use App\Repositories\Contracts\GoalRepository;
use Illuminate\Http\Request;
use Auth;
class GoalController extends Controller
{

    private $goal;

    public function __construct
    (
        GoalRepository $goal
    )
    {
        $this->goal = $goal;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $goals = $this->goal->getData();

        if ($request->ajax()) {
            if ((int)$request->query('page') > $goals->lastPage()) {
                return false;
            }

            return view('goal._goals', compact('goals'));
        }

        return view('goal.index', compact('goals'));
    }

    public function show($id)
    {
        $goal = Auth::user()->goals()->where('id', $id)->firstOrFail();

        return view('goal.show', compact('goal'));
    }

    /**
     * @param \App\Http\Requests\JobStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoalRequest $request)
    {
        $goal = $this->currentUser()->goals()->create($request->all());
        $this->currentUser()->notify(new GoalNotification($goal));
    }

    public function addTask(Request $request, $id)
    {
        $goal = $this->goal->show($id);
        $goal->tasks()->create($request->all());
        $this->goal->calProgress($goal->id);

        return response()->json($goal);
    }
}
