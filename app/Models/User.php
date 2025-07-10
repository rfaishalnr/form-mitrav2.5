<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
     * Relationship with MitraPendaftaran
     */
    public function mitraPendaftarans()
    {
        return $this->hasMany(MitraPendaftaran::class);
    }
    
    /**
     * Check if user has specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
    
    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
    
    /**
     * Filament: Determine if user can access Filament panel
     */
    // public function canAccessPanel(Panel $panel): bool
    // {
    //     // Hanya admin yang bisa akses panel admin
    //     if ($panel->getId() === 'admin') {
    //         return $this->isAdmin();
    //     }
        
    //     // Atau bisa juga dibuat semua user bisa akses tapi dengan permission terbatas
    //     return true;
    // }

    public function canAccessPanel(Panel $panel): bool
{
    return true; // semua user bisa login ke panel /admin
}

}