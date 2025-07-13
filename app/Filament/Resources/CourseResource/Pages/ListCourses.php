<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Models\Course;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Course')
                ->icon('heroicon-o-book-open')
                ->mutateFormDataUsing(function ($data) {
                    $data['code'] = Course::generateCode();

                    return $data;
                }),
        ];
    }
}
