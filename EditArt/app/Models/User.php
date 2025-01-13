<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'address', 'nif', 'phone_number', 'birthdate', 'password', 'role',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relacionamento 1:N para transações como cliente.
     */
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'user_id', 'id');
    }

    /**
     * Relacionamento 1:N para transações como staff.
     */
    public function staffTransactions()
    {
        return $this->hasMany(Transactions::class, 'staff_id', 'id');
    }

    /**
     * Relacionamento 1:N para reviews.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }


    /**
     * Relacionamento 1:N (um user pode criar varios posts).
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    /**
     * Relacionamento 1:N (um user pode fazer muitos comentários).
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
