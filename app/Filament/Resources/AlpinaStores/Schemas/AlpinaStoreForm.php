<?php

namespace App\Filament\Resources\AlpinaStores\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AlpinaStoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('address')
                    ->required()
                    ->maxLength(500),
                FileUpload::make('thumbnail')
                    ->image()
                    ->required(),
            ]);
    }
}
