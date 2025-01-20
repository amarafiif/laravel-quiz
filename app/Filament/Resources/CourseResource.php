<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Informasi Dasar')
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Course')
                            ->visibleOn('view'),
                        TextInput::make('name')
                            ->label('Nama Course')
                            ->required(),
                        MarkdownEditor::make('description')
                            ->label('Deskripsi Course')
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail Course')
                            ->image()
                            ->directory('thumbnail/course')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->required()
                    ])->columns(1),

                Fieldset::make('Pengaturan')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktifkan Course')
                            ->helperText('Atur untuk mengaktifkan course agar dapat diakses oleh member.')
                            ->inline(false),
                        Toggle::make('is_publish')
                            ->label('Publish Course')
                            ->helperText('Atur untuk menampilkan course agar dapat tampil disemua halaman.')
                            ->inline(false),
                    ])
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
                TextColumn::make('code')
                    ->label('Kode Course')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),
                TextColumn::make('name')
                    ->label('Nama Course')
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Status'),
                ToggleColumn::make('is_publish')
                    ->label('Visibilitas'),
                TextColumn::make('created_at')
                    ->label('Dibuat pada')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Terakhir diperbarui')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (DeleteAction $action) {
                        Notification::make()
                            ->danger()
                            ->title('Akses Ditolak')
                            ->body('Anda tidak diizinkan untuk menghapus data ini!')
                            ->duration(5000)
                            ->send();

                        $action->cancel();
                    })
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
            'index' => Pages\ListCourses::route('/'),
        ];
    }
}
