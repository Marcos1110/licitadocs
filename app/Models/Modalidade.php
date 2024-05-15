<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc'
    ];

    public function processo()
    {
        return $this->hasMany(Processo::class, 'processo');
    }
}
