<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class profile extends Model
{

    protected $fillable = [
        'imageUpload',
        'user_id'
        // otros campos permitidos para asignación masiva
    ];
    use HasFactory;

    public function profile(): BelongsTo
{
    return $this->belongsTo(User::class);
}
}


