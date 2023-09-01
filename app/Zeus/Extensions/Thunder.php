<?php

namespace App\Zeus\Extensions;

use Filament\Forms\Components\TextInput;
use LaraZeus\Bolt\Contracts\Extension;
use LaraZeus\Bolt\Models\Form;

class Thunder implements Extension
{
    public function label(): string
    {
        return 'Ext Name';
    }

    public function canView(Form $form, array $data): bool | array | null
    {
        // abort_if ...
        // get the ext app and return it back, so you can receive it in the render
        // return [];
    }

    public function render(Form $form, array $data): ?string
    {
        // set any data and pas it to your view
        // $data['items'] = ...

        // return view();
    }

    public function formComponents(Form $form): ?array
    {
        return [
            TextInput::make('extensions.order_number'),
        ];
    }

    public function store(Form $form, array $data): ?array
    {
        /*$model = Model::create([
            'order_number' => $data['order_number'],
            // ...
        ]);*/

        // return these data to recive them after the form submitted
        // $data['model'] = $model;

        return $data;
    }

    public function postStore(Form $form, array $data): void
    {
        // send emails
        // fire some events
    }

    public function SubmittedRender(Form $form, array $data): ?string
    {
        // return view()->with('data', $data);
    }
}
