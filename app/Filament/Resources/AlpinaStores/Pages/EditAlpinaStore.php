<?php

namespace App\Filament\Resources\AlpinaStores\Pages;

use App\Filament\Resources\AlpinaStores\AlpinaStoreResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditAlpinaStore extends EditRecord
{
    protected static string $resource = AlpinaStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
