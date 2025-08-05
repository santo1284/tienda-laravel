<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(components: [
                TextInput::make('name')
                    ->label(label: "nombre")
                    ->required()
                    ->placeholder('Nombre del Producto')
                    ->maxLength(length: 100),
                TextInput::make('description')
                    ->label(label: "descripcion")
                    ->required()
                    ->placeholder('Descripcion del Producto')
                    ->maxLength(length: 255),
                 TextInput::make('price')
                    ->label(label: "precio")
                    ->required()
                    ->placeholder('precio del Producto')
                    ->prefix(label: '$')
                    ->numeric(),
                 FileUpload::make('image')
                    ->label(label: "imagen")
                    ->required()
                    ->placeholder(placeholder: 'imagen del Producto')
                    ->image()
                    ->directory(directory: 'products'),
                 Select::make('category_id')
                    ->label(label: "categoria del producto")
                    ->required()
                    ->relationship(name: 'category', titleAttribute: 'name')
                    ->placeholder(placeholder: 'Selecciona una categoria'),
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(components: [
                TextColumn::make(name:'name')
                    ->label(label: "nombre")
                    ->sortable()
                    ->searchable(),
                TextColumn::make(name: 'description')
                    ->label(label: "descripcion")
                    ->sortable()
                    ->searchable(),
                 TextColumn::make('price')
                    ->label(label: "precio")
                    ->searchable()
                    ->prefix(prefix: '$ ')
                    ->formatStateUsing(callback: function (string $state):string {
                        return number_format(num: (float) $state, decimals:2,decimal_separator: ',',);
                    })
                    ->sortable(),
                 TextColumn::make(name: 'category_id')
                    ->label(label: "categoria")
                    ->sortable()
                    ->searchable(),

                 ImageColumn::make(name: 'image')
                    ->label(label: "imagen")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
