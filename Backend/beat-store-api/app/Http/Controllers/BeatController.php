<?php

namespace App\Http\Controllers;

use App\Models\Beat;
use App\Http\Requests\StoreBeatRequest;
use App\Http\Requests\UpdateBeatRequest;
use App\Interfaces\BeatRepositoryInterface;
use App\Classes\ResponseClass;
use App\Http\Resources\BeatResource;
use Illuminate\Support\Facades\DB;

class BeatController extends Controller
{
    private BeatRepositoryInterface $beatRepositoryInterface;
    
    public function __construct(BeatRepositoryInterface $beatRepositoryInterface)
    {
        $this->beatRepositoryInterface = $beatRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->beatRepositoryInterface->index();

        return ResponseClass::sendResponse(BeatResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store()
    {
        $beat =[
            'name' => $request->name,
            'gender' => $request->gender,
            'producerId' => $request->producerId
        ];
        DB::beginTransaction();
        try{
             $beat = $this->beatRepositoryInterface->create($beat);

             DB::commit();
             return ResponseClass::sendResponse(new BeatResource($beat),'Beat Create Successful',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $beat = $this->beatRepositoryInterface->getById($id);

        return ResponseClass::sendResponse(new BeatResource($beat),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Beat $beat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeatRequest $request, $id)
    {
        $updateBeat =[
            'name' => $request->name,
            'gender' => $request->gender,
            'producerId' => $request->producerId
        ];
        DB::beginTransaction();
        try{
             $beat = $this->beatRepositoryInterface->update($updateBeat,$id);

             DB::commit();
             return ResponseClass::sendResponse('Beat Update Successful','',201);

        }catch(\Exception $ex){
            return ResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->beatRepositoryInterface->delete($id);

        return ResponseClass::sendResponse('Beat Delete Successful','',204);
    }
}
