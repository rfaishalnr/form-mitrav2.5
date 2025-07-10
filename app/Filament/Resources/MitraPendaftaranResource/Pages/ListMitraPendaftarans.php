<?php

namespace App\Filament\Resources\MitraPendaftaranResource\Pages;

use App\Filament\Resources\MitraPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMitraPendaftarans extends ListRecords
{
    protected static string $resource = MitraPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
