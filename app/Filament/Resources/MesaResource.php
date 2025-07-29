<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MesaResource\Pages;
use App\Filament\Resources\MesaResource\RelationManagers;
use App\Models\Mesa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MesaResource extends Resource
{
    protected static ?string $model = Mesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       
    return $form->schema([
        TextInput::make('codigo')
            ->required()
            ->unique(ignoreRecord: true),

        Select::make('ubicacion')
            ->options([
                'interior' => 'Interior',
                'exterior' => 'Exterior',
            ])
            ->required(),

        TextInput::make('qr_url')
            ->label('QR URL')
            ->disabled(),
       ]);
}


    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('codigo')->searchable(),
            TextColumn::make('ubicacion'),
           Tables\Columns\ViewColumn::make('qr_url')
    ->label('Ver QR')
    ->view('components.qr-link'),

        ])
        ->defaultSort('id', 'asc')

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
            'index' => Pages\ListMesas::route('/'),
            'create' => Pages\CreateMesa::route('/create'),
            'edit' => Pages\EditMesa::route('/{record}/edit'),
        ];
    }
}
