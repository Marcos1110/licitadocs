<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    use HasFactory;

    
protected $fillable = [
	'nome',
	'setor',
	'vagas'
];

# Relacionamentos
public function setor(): BelongsTo
{
	return $this->belongsTo(Setor::class);
}

public function usuario(): HasMany
{
	return $this->hasMany(User::class);
}
}
