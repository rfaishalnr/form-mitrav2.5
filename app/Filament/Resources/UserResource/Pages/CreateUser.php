<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    
    // Pastikan hanya admin yang bisa akses
    public function mount(): void
    {
        $user = Auth::user();
    
        abort_unless($user instanceof User && $user->hasRole('admin'), 403);
    
        parent::mount();
    }
}