<?php

namespace App\Filament\Resources\AlpinaStores\Pages;

use App\Filament\Resources\AlpinaStores\AlpinaStoreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAlpinaStores extends ListRecords
{
    protected static string $resource = AlpinaStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
