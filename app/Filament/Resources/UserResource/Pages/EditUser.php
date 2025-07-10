<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    /**
     * Aksi di header, seperti tombol View dan Delete
     */
    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Validasi akses: hanya user ID 1 (admin) yang bisa edit user lain
     */
    public function mount(int|string $record): void
    {
        $user = Auth::user();

        // Batasi akses hanya untuk user dengan ID 1
        abort_unless($user instanceof User && $user->id === 1, 403);

        parent::mount($record);
    }
}
