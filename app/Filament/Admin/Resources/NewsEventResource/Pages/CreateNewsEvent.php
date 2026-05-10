<?php

namespace App\Filament\Admin\Resources\NewsEventResource\Pages;

use App\Filament\Admin\Resources\NewsEventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsEvent extends CreateRecord
{
    protected static string $resource = NewsEventResource::class;
}
