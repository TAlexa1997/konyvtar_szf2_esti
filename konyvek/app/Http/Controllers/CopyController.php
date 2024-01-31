<?php

namespace App\Http\Controllers;

use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CopyController extends Controller
{
    public function index(){
        $copies = response()->json(Copy::all());
        return $copies;
    }

    public function show($id){
        $copy = response()->json(Copy::find($id));
        return $copy;
    }

    public function store(Request $request){
        $copy = new Copy();
        $copy->book_id = $request->book_id;
        $copy->hardcovered = $request->hardcovered;
        $copy->status = $request->status;
        $copy->publication = $request->publication;
        $copy->save();
    }

    public function update(Request $request, $id){
        $copy = Copy::find($id);
        $copy->book_id = $request->book_id;
        $copy->hardcovered = $request->hardcovered;
        $copy->publication = $request->publication;
        $copy->status = $request->status;
        $copy->save();
    }
    public function destroy($id)
    {
        Copy::findOrFail($id)->delete();
    }
   //Add meg a keménykötésű példányokat szerzővel és címmel!
   // (ha megy, akkor a bármilyet tudj megadni paraméterrel; kemény: 1, puha: 0, hardcovered a mező)
    public function hAuthorTitle(){
        $books = DB::table('copies as c')	//egy tábla lehet csak
	  //->select('mezo_neve')		//itt nem szükséges
        ->join('books as b' ,'c.book_id','=','b.book_id') //kapcsolat leírása, akár több join is lehet
        ->where('hardcovered',1)
        ->get();				//esetleges aggregálás; ha select, akkor get() a vége
        return $books;
    }

    //Bizonyos évben kiadott példányok névvel és címmel kiíratása.
    public function ev($year){
        $copies = Copy::whereYear('publication',$year)	//egy tábla lehet csak
        ->join('books' ,'copies.book_id','=','books.book_id') //kapcsolat leírása, akár több join is lehet
        ->select('copies.copy_id','books.author','books.title')
        ->get();				//esetleges aggregálás; ha select, akkor get() a vége
        return response()->json($copies);;
    }

}
