<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use LaraZeus\Progress\Infolists\Components\CircleProgressEntry;
use LaraZeus\Progress\Infolists\Components\ProgressBarEntry;

class Progress extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-progress';

    protected string $view = 'filament.pages.progress';

    protected static ?int $navigationSort = 11;

    protected static ?string $navigationLabel = 'Progress';

    protected static ?string $title = 'Progress Components';

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->state([
                'onboarding_bar' => ['total' => 10, 'progress' => 7],
                'onboarding_circle' => ['total' => 10, 'progress' => 7],
                'qa_bar' => ['total' => 8, 'progress' => 3],
                'qa_circle' => ['total' => 8, 'progress' => 3],
            ])
            ->components([
                Section::make('Onboarding progress')
                    ->schema([
                        ProgressBarEntry::make('onboarding_bar')
                            ->label('Tasks done')
                            ->hideProgressValue(false),
                        CircleProgressEntry::make('onboarding_circle')
                            ->label('Completion ratio'),
                    ]),
                Section::make('QA progress')
                    ->schema([
                        ProgressBarEntry::make('qa_bar')
                            ->label('Test cases passed'),
                        CircleProgressEntry::make('qa_circle')
                            ->label('Coverage ratio')
                            ->hideProgressValue(false),
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
