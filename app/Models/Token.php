<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario',
        'certificado',
        'senha',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario');
    }

    
}
