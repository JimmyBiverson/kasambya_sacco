<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google2fa_secret',
        'failed_login_attempts',
        'locked_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'locked_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isLocked(): bool
    {
        return $this->locked_at !== null;
    }

    public function incrementFailedAttempts(): void
    {
        $this->increment('failed_login_attempts');

        if ($this->failed_login_attempts >= 5) {
            $this->update(['locked_at' => now()]);
        }
    }

    public function resetFailedAttempts(): void
    {
        $this->update([
            'failed_login_attempts' => 0,
            'locked_at' => null,
        ]);
    }

    public function loginHistories(): HasMany
    {
        return $this->hasMany(LoginHistory::class);
    }

    public function ipAllowlists(): HasMany
    {
        return $this->hasMany(UserIpAllowlist::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
