<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Enums\DiscountType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StocksRelationManager extends RelationManager
{
    protected static string $relationship = 'stocks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('price')
                    ->nullable()
                    ->prefix('$')
                    ->numeric()
                    ->inputMode('decimal'),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('discount_type')
                    ->options([
                        DiscountType::PERCENTAGE->value=>"PERCENTAGE",
                        DiscountType::VALUE->value=>"VALUE"
                    ])
                    ->native(false)
                    ->nullable()
                    ->live(),
                Forms\Components\TextInput::make('discount')
                    ->numeric()
                    ->nullable()
                    ->visible(fn(Get $get)=>$get('discount_type'))
                    ->live(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('stocks')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
