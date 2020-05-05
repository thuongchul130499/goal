<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalRequest;
use App\Goal;
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $goals = $this->goal->getData();

        return view('goal.index', compact('goals'));
    }

    /**
     * @param \App\Http\Requests\JobStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoalRequest $request)
    {
        Auth::user()->goals()->create($request->all());
    }
}
