<?php


namespace App\Repositories\Eloquents;

use App\Note;
use App\Repositories\Contracts\NoteRepository;
use Illuminate\Http\Request;

class NoteEloquentRepository extends AbstractEloquentRepository implements NoteRepository
{
    public function model()
    {
        return new Note();
    }

    public function index($with = [], $data = [], $dataSelect = ['*']) {

    }

    public function show($id, $with = []) {

    }

    public function store(Request $data) {

    }

    public function update($id, Request $data) {

    }

    public function destroy($id) {

    }
}
