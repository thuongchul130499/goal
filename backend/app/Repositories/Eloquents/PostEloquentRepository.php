<?php

namespace App\Repositories\Eloquents;

use App\Post;
use App\Repositories\Contracts\PostRepository;
use Illuminate\Http\Request;
use Auth, DB;

class PostEloquentRepository extends AbstractEloquentRepository implements PostRepository
{
    public function model()
    {
        return new Post;
    }

    public function getData($with = [], $data = [], $dataSelect = ['*'])
    {
    }

    public function paginate(Request $request, $with = [])
    {
        return $this->model()
            ->with($with)
            ->where('user_id', $request->user_id)
            ->where('mode', Post::PUBLIC)
            ->orderBy('created_at', 'desc')
            ->paginate(
                10, ['*'], 'page', $request->page
            );
    }

    public function show($id, $with = [])
    {
        return $this->model()->with($with)->findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $post = Auth::user()->posts()->create($request->all());
            if ($request->has('images')) {
                foreach ($request->images as $file) {
                    $name = $file->store('public/posts');
                    $data[] = [
                        'data' => $name
                    ];
                }
                $post->medias()->createMany($data);
            }
            DB::commit();
            $response = [
                'status' => true,
                'message' => 'Create successfully',
                'post' => $this->show($post->id, ['user', 'medias']),
            ];
        } catch (\Exception $e) {
            $response =  [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }

        return $response;
    }

    public function update($id, $data)
    {
    }

    public function destroy($id)
    {
    }

    public function changeMode($id, $data)
    {
    }
}
