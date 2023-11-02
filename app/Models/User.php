<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**php artisan vendor:publish --tag=livewire-powergrid-config
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_admin',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRedirectRoute()
    {
        return match((int)$this->roles[0]['id']) {
            1 => 'dashboard', // local student
            2 => '/', // international student
            3 => 'afo/dashboard', // afo
            4 => 'sro/dashboard', // sro
            5 => 'sro/dashboard', // iso
            6 => 'aaro/dashboard', // aaro
            7 => 'admin-dashboard', // superadmin
            8 => 'admin-dashboard', // admin
            // ...
        };
    }

    public function canAccessFilament(): bool
    {
        return $this->email == 'ccooas@sc.edu.my' && $this->hasVerifiedEmail();
    }

}
