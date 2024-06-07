<?php

namespace App\Interfaces;

interface ProducerRepositoryInterface
{
    public function index();
    public function getById($id);
    public function create(array $data);
    public function update(array $data,$id);
    public function delete($id);
}
