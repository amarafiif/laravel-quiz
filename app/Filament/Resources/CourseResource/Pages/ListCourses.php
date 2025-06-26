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
                    $lastRecord = Course::orderBy('id', 'desc')->first();

                    if (!$lastRecord) {
                        $data['code'] = '#LAQC000001';
                    } else {
                        $lastNumber = (int) substr($lastRecord->code, 5);
                        $nextNumber = $lastNumber + 1;
                        $data['code'] = '#LAQC' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
                    }
                    return $data;
                })
        ];
    }
}
