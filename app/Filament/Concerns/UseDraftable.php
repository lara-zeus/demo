<?php

namespace App\Filament\Concerns;

use Filament\Actions\Action;
use Filament\Notifications\Notification;

trait UseDraftable
{
    public $val;

    public function mount(): void
    {
        parent::mount();

        $id = $this->form->getModel();

        $this->js('
            let getValues = JSON.parse(window.localStorage.getItem("'.$id.'"));
            $wire.set("val", getValues)
        ');
    }

    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),

            Action::make('saveDraft')
                ->action(function() {
                    $data = $this->form->getState(false);
                    $id = $this->form->getModel();

                    $this->js('
                        localStorage.setItem("'.$id.'", JSON.stringify('.json_encode($data).'))
                    ');

                    Notification::make()
                        ->title('Draft saved successfully')
                        ->success()
                        ->send();
                })
                ->color('info'),

            Action::make('restoreDraft')
                ->action(function() {
                    $id = $this->form->getModel();
                    $this->js('
                        $wire.set(
                            "val",
                            JSON.parse(window.localStorage.getItem("'.$id.'"))
                         )
                    ');
                    $this->form->fill($this->val ?? []);

                    Notification::make()
                        ->title('Draft restored successfully')
                        ->success()
                        ->send();
                })
                ->color('info'),
        ];
    }
}