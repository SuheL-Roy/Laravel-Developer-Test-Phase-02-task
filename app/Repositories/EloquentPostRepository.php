<?php
namespace App\Repositories;

use App\Models\Post;

class EloquentPostRepository implements PostRepositoryInterface {
    public function all($search = null) {
        return Post::when($search, fn($q) => $q->where('title', 'like', "%$search%"))
            ->latest()->paginate(10);
    }

    public function find($id) {
        return Post::findOrFail($id);
    }

    public function store(array $data) {
        return Post::create($data);
    }

    public function update($id, array $data) {
        $post = $this->find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id) {
        return Post::destroy($id);
    }
}
