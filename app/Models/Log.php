<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario',
        'documento',
        'operacao'
    ];
    
    # Relacionamentos
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function documento(): BelongsTo
    {
        return $this->belongsTo(Documento::class);
    }
    
    public function operacao(): BelongsTo
    {
        return $this->belongsTo(Operacao::class);
    }
}
