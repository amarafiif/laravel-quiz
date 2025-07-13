<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers\QuizzesRelationManager;
use App\Models\Course;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
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
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        Grid::make(2)
                            ->visibleOn(['edit', 'view'])
                            ->schema([
                                TextInput::make('code')
                                    ->label('Kode Course')
                                    ->disabledOn('edit'),
                            ]),
                        TextInput::make('name')
                            ->label('Nama Course')
                            ->required()
                            ->placeholder('Sejarah Indonesia')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str($state)->slug())),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->placeholder('sejarah-indonesia')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->disabledOn('edit'),
                        MarkdownEditor::make('description')
                            ->label('Deskripsi Course')
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->directory('courses/thumbnails')
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file, $get): string => 'thumb-'.str($get('name') ?? '')
                                    ->slug().'-'.($get('code') ?? '').'.'.$file->getClientOriginalExtension()
                            )
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->hint(new HtmlString(
                                '1920x1080px'
                            ))
                            ->hintColor('warning')
                            ->optimize('webp')
                            ->required(),
                    ]),

                Section::make('Pengaturan')
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktifkan Course')
                            ->helperText('Atur untuk mengaktifkan course agar dapat diakses oleh member.')
                            ->inline(false),
                        Toggle::make('is_publish')
                            ->label('Publish Course')
                            ->helperText('Atur untuk menampilkan course agar dapat tampil disemua halaman.')
                            ->inline(false),
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
                TextColumn::make('code')
                    ->label('Kode')
                    ->badge()
                    ->copyable()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),
                TextColumn::make('name')
                    ->label('Nama Kursus')
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Status Aktif'),
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
                    ->dateTime()
                    ->toggleable(),
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
                            ->send();

                        $action->cancel();
                    }),
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
            QuizzesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
