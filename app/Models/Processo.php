<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    use HasFactory;

    protected $fillable = ['objeto'];

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    public function modalidade()
    {
        return $this->belongsTo(Modalidade::class, 'modalidade');
    }
}
