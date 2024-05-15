<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'tipo',
        'processo',
        'precisaAssinar',
        'assinado',
        'remetente',
        'destinatario',
        'arquivo'
    ];

    // Relacionamento Documento pertence a um Tipo
    public function tipo()
    {
        return $this->belongsTo(TiposDocumento::class);
    }

    // Relacionamento Documento pertence a um Processo
    public function processo()
    {
        return $this->belongsTo(Processo::class);
    }
}
