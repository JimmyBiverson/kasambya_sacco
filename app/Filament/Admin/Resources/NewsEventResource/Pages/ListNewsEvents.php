<?php

namespace App\Filament\Admin\Resources\NewsEventResource\Pages;

use App\Filament\Admin\Resources\NewsEventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsEvents extends ListRecords
{
    protected static string $resource = NewsEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
