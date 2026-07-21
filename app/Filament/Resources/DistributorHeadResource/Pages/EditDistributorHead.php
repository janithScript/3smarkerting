<?php

namespace App\Filament\Resources\DistributorHeadResource\Pages;

use App\Filament\Resources\DistributorHeadResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributorHead extends EditRecord
{
    protected static string $resource = DistributorHeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
