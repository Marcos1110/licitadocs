<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Envio extends Model
{
    use HasFactory;

    protected $fillable = [
        'destinatario',
        'documento',
        'precisaAssinar',
    ];
    
    # Relacionamentos
    public function destinatario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function documento(): BelongsTo
    {
        return $this->belongsTo(Documento::class);
    }
}
