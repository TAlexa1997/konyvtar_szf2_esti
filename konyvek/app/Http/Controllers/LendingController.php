<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $copies = response()->json(Lending::all());
        return $copies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lending=new Lending();
        $lending ->user_id = $request ->user_id;
        $lending -> copy_id = $request ->copy_id;
        $lending -> start = $request-> start;
    }
    
    public function show (Request $request,$user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
    }

    

    /**
     * Egyenlőre ezt nincs értelme 
     */
    //public function update(Request $request,$user_id, $copy_id, $start)
    //{
      //  $lending = $this->show($user_id, $copy_id, $start);
        
    //}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lending $lending)
    {
        $lending->delete();
    }
}
