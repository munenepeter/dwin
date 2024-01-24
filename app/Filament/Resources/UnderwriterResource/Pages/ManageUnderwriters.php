<?php

namespace App\Filament\Resources\UnderwriterResource\Pages;

use App\Filament\Resources\UnderwriterResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUnderwriters extends ManageRecords
{
    protected static string $resource = UnderwriterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
