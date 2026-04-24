<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use LaraZeus\ActivityTimeline\Components\ActivityDate;
use LaraZeus\ActivityTimeline\Components\ActivityDescription;
use LaraZeus\ActivityTimeline\Components\ActivityIcon;
use LaraZeus\ActivityTimeline\Components\ActivitySection;
use LaraZeus\ActivityTimeline\Components\ActivityTitle;

class ActivityTimeline extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-clock-hour-4';

    protected string $view = 'filament.pages.activity-timeline';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'Activity Timeline';

    protected static ?string $title = 'Activity Timeline';

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->state([
                'activities' => [
                    [
                        'icon' => 'tabler-user-plus',
                        'title' => 'New user registered',
                        'description' => 'A new account was created from the public registration form.',
                        'date' => now()->subHours(6),
                    ],
                    [
                        'icon' => 'tabler-edit-circle',
                        'title' => 'Profile updated',
                        'description' => 'The account owner updated name and timezone preferences.',
                        'date' => now()->subHours(3),
                    ],
                    [
                        'icon' => 'tabler-shield-check',
                        'title' => 'Permissions reviewed',
                        'description' => 'Administrator verified role assignments for this account.',
                        'date' => now()->subHour(),
                    ],
                ],
            ])
            ->components([
                ActivitySection::make('activities')
                    ->label('Recent activity')
                    ->description('Demo timeline rendered with lara-zeus/activity-timeline.')
                    ->showItemsCount(2)
                    ->showItemsLabel('Load more items')
                    ->showItemsIcon('tabler-chevron-down')
                    ->schema([
                        ActivityIcon::make('icon'),
                        ActivityTitle::make('title'),
                        ActivityDate::make('date')->date('M d, Y H:i'),
                        ActivityDescription::make('description'),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
