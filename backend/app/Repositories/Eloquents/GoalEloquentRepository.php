<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\GoalRepository;
use App\Goal;
use Carbon\Carbon;
use Exception, Auth;

class GoalEloquentRepository extends AbstractEloquentRepository implements GoalRepository
{
    public function model()
    {
        return new Goal;
    }

    public function getData($with = [], $data = [], $dataSelect = ['*'])
    {
        return Auth::user()
            ->goals()
            ->with($with)
            ->select($dataSelect)
            ->paginate(5);
    }

    public function show($id, $with =[] )
    {
        return $this->model()->with($with)->findOrFail($id);
    }

    public function calProgress($id)
    {
        try{
            $goal = $this->show($id, ['tasks']);
            $total = $goal->tasks->sum('progress');
            $progress = $goal->tasks->count() > 0 ? $total / $goal->tasks->count() : 0;
            $goal->update(['progress' => $progress]);
            return $goal->refresh();
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
