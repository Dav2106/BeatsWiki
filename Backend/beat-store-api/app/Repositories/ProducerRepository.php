<?php

namespace App\Repositories;
use App\Models\Producer;
use App\Interfaces\ProducerRepositoryInterface;

class ProducerRepository implements ProducerRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    public function index(){
        return Producer::all();
    }

    public function getById($id){
       return Producer::findOrFail($id);
    }

    public function create(array $data){
       return Producer::create($data);
    }

    public function update(array $data,$id){
       return Producer::whereId($id)->update($data);
    }
    
    public function delete($id){
       Producer::destroy($id);
    }
}
