<?php

namespace App\Http\Controllers;
use App\Models\Vlog;

use Illuminate\Http\Request;

class VlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }


    public function index(Request $request){
        $search = $request->input('search');

        $query = Vlog::query();

        if($search){
            $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('desc', 'like', '%' . $search . '%');
        }

        $vlogs = $query->get();

        return response()->json($vlogs);
    }   
    
    
    public function create(Request $request){

        if(!$request->title || !$request->desc){
            return response()->json(["message" => "All fields are required"], 400);
        }

        $newvlog = Vlog::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'posted_by' => auth()->user()->id
        ]);

        if($newvlog->save()){
            return response()->json(["message" => "Vlog created successfully"], 201);
        }

        return response()->json(["message" => "Something went wrong"], 500);

    }

    public function update(Request $request, int $id){

        if(!$id){
            return response()->json(["message" => "Id is required"], 400);
        }

        $vlog = Vlog::find($id);

        if($vlog){
            $vlog->update($request->all());

            if($vlog->save()){
                return response()->json(["message" => "Vlog updated successfully"], 200);
            }
            
        return response()->json(["message" => "Something went wrong"], 500);
        }

        return response()->json(["message" => "Vlog not found"], 404);

    }


    public function delete(int $id){

        if(!$id){
            return response()->json(["message" => "Id is required"], 400);
        }

        $vlog = Vlog::find($id);

        if($vlog){

            $vlog->delete();
            return response()->json(["message" => "Vlog deleted successfully"], 200);    
        }

        return response()->json(["message" => "Vlog not found"], 404);
    }
}

