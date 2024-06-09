<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'responsavel',
        'processo',
        'arquivo'
    ];
    
    # Relacionamentos
    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function processo(): BelongsTo
    {
        return $this->belongsTo(Processo::class);
    }
    
    public function envio(): HasMany
    {
        return $this->hasMany(Envio::class);
    }
    
    public function log(): HasMany
    {
        return $this->hasMany(Log::class);
    }
    
}
