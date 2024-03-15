<?php

namespace App\Contracts;

interface UserServiceInterface
{
    public function index();
    public function find(string $id);
    public function singleUser(string $id);
    public function store(array $data);
    public function update(array $data, string $id);
    public function trash(string $id);
    public function trashed();
    public function restore(string $id);
    public function destroy(string $id);
}
