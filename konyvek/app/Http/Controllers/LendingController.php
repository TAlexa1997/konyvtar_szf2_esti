<?php

namespace App\Http\Controllers;

use App\Models\Copy;
use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LendingController extends Controller
{
    
    public function index()
    {
        $copies = response()->json(Lending::all());
        return $copies;
    }

    
    public function store(Request $request)
    {
        $lending=new Lending();
        $lending ->user_id = $request ->user_id;
        $lending -> copy_id = $request ->copy_id;
        $lending -> start = $request-> start;
        $lending -> save();
    }
    
    public function show (Request $request,$user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
    }

    
    public function destroy($user_id,$copy_id,$start)
    {
        Lending::where('user_id',$user_id)
        ->where('copy_id',$copy_id)
        ->where('start',$start)->delete();
    }

    public function allLendingUserCopy()
    {
        $copies = Lending::with(['copies', 'users']) //a függvény neve a modellben
            ->get();

        return $copies;
    }

    public function allLendingBookCopy()
    {
        $books = Lending::with(['copies', 'books']) // modellben lévő függvény neve
            ->get();

        return $books;
    }

    public function lendingsOnDate($myDate){
        
        $taskRanges = Lending::with('books') // modellben lévő függvény neve
        ->where('start', $myDate)
        ->get();
        return $taskRanges;
    }

    public function coppiesOnDate($copyid) {
        $name = Lending::with('copies') // modellben lévő függvény neve
        ->where('copy_id', $copyid)
        ->get();
        return $name;
    }

 
   

}
