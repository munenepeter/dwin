<?php

namespace App\Filament\Resources;

use App\Filament\Exports\ClientExporter;
use App\Filament\Imports\ClientImporter;
use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Tables\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\ExportAction;

class ClientResource extends Resource {
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Clients';

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('full_names')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('policy_number')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('risk_id')
                                    ->helperText('KAB 123A (Vehicle reg no.)')
                                    ->label('Risk ID')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Premiums')
                            ->schema([

                                Forms\Components\TextInput::make('sum_insured')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('rate')
                                    ->helperText('Premium rate in %')
                                    ->required()
                                    ->numeric()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $sum_insured = $get('sum_insured');
                                        $set('basic_premium', $sum_insured * ($state / 100));
                                    }),
                                Forms\Components\TextInput::make('political_risk')
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->numeric()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('annual_total_premium', $get('basic_premium') + $state);
                                    }),
                                Forms\Components\TextInput::make('excess_protector')
                                    ->rules(['regex:/^\d{1,6}(\.\d{0,2})?$/'])
                                    ->numeric()->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, Forms\Get $get) {
                                        if ($operation !== 'create') {
                                            return;
                                        }
                                        $set('annual_total_premium', $get('basic_premium') + $get('political_risk') + $state);
                                    }),


                            ])
                            ->columns(2),
                        Forms\Components\Section::make('Premium Calculations')
                            ->schema([
                                Forms\Components\TextInput::make('basic_premium')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('annual_total_premium')
                                    ->required()
                                    ->numeric(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\DatePicker::make('annual_expiry_date')
                                    ->required()
                                    ->default(now()),
                                Forms\Components\DatePicker::make('annual_renewal_date')
                                    ->default(now()->addYear())
                                    ->required(),
                            ]),

                        Forms\Components\Section::make('Associations')
                            ->schema([
                                Forms\Components\Select::make('insurance_id')
                                    ->relationship('insurance', 'name')
                                    ->required()
                                    ->searchable(),
                                Forms\Components\Select::make('underwriter_id')
                                    ->relationship('underwriter', 'name')
                                    ->required()
                                    ->searchable(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_names')
                    ->description(fn (Client $record): string => $record->risk_id, position: 'above')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('policy_number')
                    ->description(fn (Client $record): string => ucwords($record->underwriter->name))
                    ->searchable(),
                Tables\Columns\TextColumn::make('sum_insured')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('political_risk')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('excess_protector')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('basic_premium')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('annual_total_premium')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('annual_expiry_date')
                    ->date()
                    ->description(fn (Client $record): string => $record->annual_renewal_date)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ClientExporter::class),
                ImportAction::make()
                    ->importer(ClientImporter::class)
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

    public static function getRelations(): array {
        return [
            //
        ];
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
