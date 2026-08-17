<?php

namespace App\Filament\Pages;

use App\Models\SpeedTestResult;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class SpeedTest extends Page
{
    protected string $view = 'filament.pages.speed-test';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;

    protected static string|UnitEnum|null $navigationGroup = 'Business';

    protected static ?string $title = 'Speed Test';

    protected static ?int $navigationSort = 2;

    public function getRecentResultsProperty()
    {
        return SpeedTestResult::query()
            ->latest()
            ->limit(8)
            ->get();
    }
}
