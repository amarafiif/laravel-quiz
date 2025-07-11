<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class MemberResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Member';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Users';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'member');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Member')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),
                        TextInput::make('username')
                            ->label('Username')
                            ->required(),
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->required(),
                        Hidden::make('role')
                            ->default('member')
                            ->required(),
                        DateTimePicker::make('email_verified_at')
                            ->label('Verifikasi Email'),
                    ]),

                Fieldset::make('Kredensial')
                    ->schema([
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->visibleOn('create'),
                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->same('password')
                            ->dehydrated(false)
                            ->visibleOn('create'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email_verified_at')
                    ->label('Verifikasi Email')
                    ->badge()
                    ->state(function ($record) {
                        return $record->email_verified_at ? 'verified' : 'unverified';
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            'verified' => 'success',
                            'unverified' => 'gray',
                        };
                    })
                    ->icon(function ($state) {
                        return match ($state) {
                            'verified' => 'heroicon-o-check-circle',
                            'unverified' => 'heroicon-o-x-circle',
                        };
                    })
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'verified' => 'Sudah Verifikasi',
                            'unverified' => 'Belum Verifikasi',
                        };
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Bergabung pada')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Terakhir diperbarui')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->disabled(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->disabled(),
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
            'index' => Pages\ListMembers::route('/'),
        ];
    }
}
