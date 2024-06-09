<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];
    
    # Relacionamentos
    public function log(): HasMany
    {
        return $this->hasMany(Log::class);
    }
}
