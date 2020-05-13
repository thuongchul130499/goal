<?php

namespace App\Repositories\Contracts;

use App\Eloquent\User;

interface UserRepository extends BaseAbstractRepository
{
    public function getData($with = [], $data = [], $dataSelect = ['*']);

    public function update($id, $data);
}