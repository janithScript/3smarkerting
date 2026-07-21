<?php

namespace App\Filament\Resources\DistributorHeadResource\Pages;

use App\Filament\Resources\DistributorHeadResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributorHeads extends ListRecords
{
    protected static string $resource = DistributorHeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
