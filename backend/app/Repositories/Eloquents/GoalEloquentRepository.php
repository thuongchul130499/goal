<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\GoalRepository;
use App\Goal;
use Carbon\Carbon;
class GoalEloquentRepository extends AbstractEloquentRepository implements GoalRepository
{
    public function model()
    {
        return new Goal;
    }

    public function getData($with = [], $data = [], $dataSelect = ['*'])
    {
        return $this->model()
                     ->with($with)
                     ->select($dataSelect)
                     ->paginate(10);
    }
}
