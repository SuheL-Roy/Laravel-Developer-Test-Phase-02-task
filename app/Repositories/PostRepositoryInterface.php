<?php
namespace App\Repositories;

interface PostRepositoryInterface {
    public function all($search = null);
    public function find($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}
