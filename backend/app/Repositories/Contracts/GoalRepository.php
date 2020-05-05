<?php

namespace App\Repositories\Contracts;

use App\Eloquent\Goal;

interface GoalRepository extends BaseAbstractRepository
{
    public function getData($with = [], $data = [], $dataSelect = ['*']);
}
