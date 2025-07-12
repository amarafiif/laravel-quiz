<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Pages\Actions\ActionGroup;
use Filament\Resources\Pages\ViewRecord;

class ViewCourse extends ViewRecord
{
    protected static string $resource = CourseResource::class;

    protected function getActions(): array
    {
        return [
            ActionGroup::make([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
                ->button()
                ->icon('heroicon-o-ellipsis-horizontal')
                ->label('Aksi Lainnya'),

        ];
    }
}
