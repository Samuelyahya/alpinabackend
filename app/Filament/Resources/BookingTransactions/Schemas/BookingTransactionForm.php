<?php

namespace App\Filament\Resources\BookingTransactions\Schemas;

use App\Models\Vehicle;
use BcMath\Number;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class BookingTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product and Price')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('vehicle_id')
                                        ->relationship('vehicle', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $vehicle = Vehicle::find($state);
                                            $price = $vehicle ? $vehicle->price : 0;
                                            $duration = $vehicle ? $vehicle->duration : 0;
                                            $insurance = 500000;

                                            $tax = 0.11;
                                            $totalTaxAmount = $tax * $price;

                                            $totalAmount = $price + $totalTaxAmount + $insurance;

                                            $set('total_tax_amount', number_format($totalTaxAmount, 0, '', ''));
                                            $set('insurance', $insurance);
                                            $set('price', $price);
                                            $set('duration', $duration);
                                            $set('total_amount', number_format($totalAmount, 0, '', ''));
                                        })
                                        ->afterStateHydrated(function ($state, callable $set, callable $get) {
                                            $vehicle = Vehicle::find($state);
                                            $price = $vehicle ? $vehicle->price : 0;
                                            $duration = $vehicle ? $vehicle->duration : 0;
                                            $insurance = 500000;

                                            $tax = 0.11;
                                            $totalTaxAmount = $tax + $price;

                                            $totalAmount = $price + $totalTaxAmount + $insurance;

                                            $set('total_tax_amount', number_format($totalTaxAmount, 0, '', ''));
                                            $set('insurance', $insurance);
                                            $set('price', $price);
                                            $set('duration', $duration);
                                            $set('total_amount', number_format($totalAmount, 0, '', ''));
                                        }),

                                    TextInput::make('duration')
                                        ->required()
                                        ->numeric()
                                        ->readOnly()
                                        ->prefix('Days'),
                                    TextInput::make('total_amount')
                                        ->required()
                                        ->numeric()
                                        ->readOnly()
                                        ->prefix('IDR'),
                                    TextInput::make('price')
                                        ->required()
                                        ->numeric()
                                        ->readOnly()
                                        ->prefix('IDR'),
                                    TextInput::make('total_tax_amount')
                                        ->required()
                                        ->numeric()
                                        ->readOnly()
                                        ->prefix('IDR'),
                                    TextInput::make('insurance')
                                        ->required()
                                        ->numeric()
                                        ->readOnly()
                                        ->prefix('IDR'),
                                    DatePicker::make('started_at')
                                        ->required(),
                                    Select::make('alpina_store_id')
                                        ->relationship('alpinaStore', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->required(),

                                ]),
                        ]),

                    Step::make('Customer Information')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('phone')
                                        ->required()
                                        ->maxLength(255),
                                    TextInput::make('email')
                                        ->required()
                                        ->maxLength(255),
                                ])
                        ]),

                    Step::make('Payment Information')
                        ->schema([
                            TextInput::make('booking_trx_id')
                                ->required()
                                ->maxLength(255),
                            ToggleButtons::make('is_paid')
                                ->label('Apakah sudah membayar?')
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    true => 'heroicon-o-pencil',
                                    false => 'heroicon-o-clock'
                                ])
                                ->required(),
                            FileUpload::make('proof')
                                ->image()
                                ->required(),
                        ]),
                ])
                    ->columnSpanFull()
                    ->columns(1)
                    ->skippable(),
            ]);
    }
}
