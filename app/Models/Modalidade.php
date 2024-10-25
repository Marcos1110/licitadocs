<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modalidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];
    
    # Relacionamentos
    public function processo(): HasMany
    {
        return $this->hasMany(Processo::class);
    }
}
