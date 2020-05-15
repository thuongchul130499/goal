<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface NoteRepository extends BaseAbstractRepository
{
    public function index($with = [], $data = [], $dataSelect = ['*']);

    public function show($id, $with = []);

    public function store(Request $data);

    public function update($id, Request $data);

    public function destroy($id);
}
