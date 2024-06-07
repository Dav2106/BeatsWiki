<?php

namespace App\Repositories;
use App\Models\Beat;
use App\Interfaces\BeatRepositoryInterface;

class BeatRepository implements BeatRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    public function index(){
        return Beat::all();
    }

    public function getById($id){
       return Beat::findOrFail($id);
    }

    public function create(array $data){
       return Beat::create($data);
    }

    public function update(array $data,$id){
       return Beat::whereId($id)->update($data);
    }
    
    public function delete($id){
       Beat::destroy($id);
    }
}
