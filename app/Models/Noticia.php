<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'subtitulo', 'contenido', 'user_id', 'portada'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   
}
