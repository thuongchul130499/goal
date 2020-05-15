<?php

namespace App\Repositories\Contracts;

use App\Eloquent\Post;
use Illuminate\Http\Request;

interface PostRepository extends BaseAbstractRepository
{
    public function getData($with = [], $data = [], $dataSelect = ['*']);

    public function show($id, $with = []);

    public function store(Request $data);

    public function update($id, Request $data);

    public function destroy($id);

    public function changeMode($id, $data);
}
