<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Interfaces\ProducerRepositoryInterface;
use App\Classes\ResponseClass;
use App\Http\Resources\ProducerResource;
use Illuminate\Support\Facades\DB;

class ProducerController extends Controller
{
    private ProducerRepositoryInterface $producerRepositoryInterface;
    
    public function __construct(ProducerRepositoryInterface $producerRepositoryInterface)
    {
        $this->producerRepositoryInterface = $producerRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->producerRepositoryInterface->index();

        return ResponseClass::sendResponse(ProducerResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producer =[
            'name' => $request->name,
            'gender' => $request->gender
        ];
        DB::beginTransaction();
        try{
             $Producer = $this->producerRepositoryInterface->create($producer);

             DB::commit();
             return ResponseClass::sendResponse(new ProducerResource($Producer),'Producer Create Successful',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Producer = $this->producerRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new ProducerResource($Producer),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producer $Producer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProducerRequest $request, $id)
    {
        $updateProducer =[
            'name' => $request->name,
            'gender' => $request->gender
        ];
        DB::beginTransaction();
        try{
             $Producer = $this->producerRepositoryInterface->update($updateProducer,$id);

             DB::commit();
             return ResponseClass::sendResponse('Producer Update Successful','',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->producerRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Producer Delete Successful','',204);
    }
}
