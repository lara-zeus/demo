<?php

namespace App\Filament\Guests\Pages;

use App\Mason\BrickCollection;
use App\Models\Mason as MasonModel;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use UnitEnum;

class Mason extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'tabler-building-castle';

    protected static string | UnitEnum | null $navigationGroup = 'Plugins';

    protected string $view = 'filament.guests.pages.mason';

    protected ?string $heading = 'A simple block based builder';

    public ?array $data = [];

    public MasonModel $post;

    public function mount(): void
    {
        $this->post = MasonModel::first();
        $this->form->fill($this->post?->toArray() ?? []);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->model($this->post)
            ->components([
                \Awcodes\Mason\Mason::make('content')
                    ->bricks(BrickCollection::make())
                    ->placeholder('Drag and drop bricks to get started...'),
            ]);
    }

    public function store()
    {
        $data = $this->form->getState();
        if ($data !== null) {
            $this->post->update($data);
        }

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
