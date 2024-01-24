<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    //összetett kulcs megadása:
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('copy_id', '=', $this->getAttribute('copy_id'))
            ->where('start', '=', $this->getAttribute('start'));
        return $query;
    }

    public function copies(){
        return $this->belongsTo(Copy::class,'copy_id', 'copy_id');
    }

    public function users(){
        return $this->hasOne(User::class,'id', 'user_id');
    }

    public function books(){
        return $this->belongsTo(Book::class,'id', 'books_id');
    }

    public function lendings(){
        return $this->hasOne(Lending::class,'id', 'lendings_id');
    }

    


    protected $fillable = [
        'user_id',
        'copy_id',
        'start'
    ];
}
