<?php

namespace App\Filament\Resources\AlpinaStores;

use App\Filament\Resources\AlpinaStores\Pages\CreateAlpinaStore;
use App\Filament\Resources\AlpinaStores\Pages\EditAlpinaStore;
use App\Filament\Resources\AlpinaStores\Pages\ListAlpinaStores;
use App\Filament\Resources\AlpinaStores\Schemas\AlpinaStoreForm;
use App\Filament\Resources\AlpinaStores\Tables\AlpinaStoresTable;
use App\Models\AlpinaStore;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlpinaStoreResource extends Resource
{
    protected static ?string $model = AlpinaStore::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Alpina Store';

    public static function form(Schema $schema): Schema
    {
        return AlpinaStoreForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AlpinaStoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAlpinaStores::route('/'),
            'create' => CreateAlpinaStore::route('/create'),
            'edit' => EditAlpinaStore::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
