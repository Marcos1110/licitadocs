<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'telefone',
        'cpf',
        'password',
        'cargo',
        'administrador'
    ];
    
    # Relacionamentos
    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }
    
    public function certificado(): HasOne
    {
        return $this->hasOne(Certificado::class);
    }
    
    public function documento(): HasMany
    {
        return $this->hasMany(Documento::class);
    }
    
    public function envio(): HasMany
    {
        return $this->hasMany(Envio::class);
    }
    
    public function log(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    /**
     * Route notifications for the Vonage channel.
     */
    public function routeNotificationForVonage(): string
    {

        return $this->telefone;
    }
}
