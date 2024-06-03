<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Token;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'department',
        'role',
        'email',
        'is_admin',
        'phone',
        'cpf',
        'password',
    ];

    public function token()
    {
        return $this->hasOne(Token::class, 'usuario');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department');
    }

    /**
     * Route notifications for the Vonage channel.
     */
    public function routeNotificationForVonage(Notification $notification): string
    {
        //$phone = $notification->remetente->phone;

        return $this->phone;
    }

    
}
