<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Stock;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\DiscountType;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Console\Input\Input;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Support\Facades\Storage;

class StocksRelationManager extends RelationManager
{
    protected static string $relationship = 'stocks';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->nullable()
                            ->prefix('$')
                            ->numeric()
                            ->inputMode('decimal'),
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->numeric(),
                        Forms\Components\Toggle::make('status'),
                    ])->columns(3),
                forms\Components\Section::make()
                ->schema([
                    Forms\Components\Select::make('discount_type')
                        ->default(0)
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
                        ])->columns(3),
                Forms\Components\Repeater::make('properties')
                    ->schema([
                        Forms\Components\TextInput::make('key')->required(),
                        Forms\Components\TextInput::make('value')->required()
                    ])->columns(2)
                    ->columnSpanFull()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('price')->prefix('$'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('discount')->prefix(
                    fn(Stock $record)=>$record->discount_type==DiscountType::PERCENTAGE->value?'%':(
                        $record->discount_type==DiscountType::VALUE->value?'$':''
                    )
                ),
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\IconColumn::make('status')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->before(fn(Model $record)=>
                            Storage::disk('public')->delete($record->image)
                        ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
