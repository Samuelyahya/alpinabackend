<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Details')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Select::make('is_popular')
                            ->options([
                                true => 'Popular',
                                false => 'Not Popular'
                            ])
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->image()
                            ->required(),
                        Repeater::make('photos')
                            ->relationship('photos')
                            ->schema([
                                FileUpload::make('photo')
                                    ->required(),
                            ])
                    ]),
                Fieldset::make('Additional')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('horse_power')
                            ->required()
                            ->numeric()
                            ->prefix('HP'),
                        TextInput::make('max_speed')
                            ->required()
                            ->numeric()
                            ->prefix('KMH'),
                        TextInput::make('cc')
                            ->required()
                            ->numeric()
                            ->prefix('Power CC'),
                        Textarea::make('about')
                            ->required(),
                        TextInput::make('duration')
                            ->required()
                            ->numeric()
                            ->prefix('Days'),
                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR'),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),
            ]);
    }
}
