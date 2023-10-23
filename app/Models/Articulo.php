<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Escritor;
class Articulo extends Model
{
    use HasFactory;

    public function escritor()
    {
        return $this->belongsTo(Escritor::class, 'escritors_id');
    }
}
