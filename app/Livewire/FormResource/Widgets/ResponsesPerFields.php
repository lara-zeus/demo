<?php

namespace LaraZeus\Bolt\Filament\Resources\FormResource\Widgets;

use Filament\Widgets\ChartWidget;
use LaraZeus\Bolt\BoltPlugin;
use LaraZeus\Bolt\Models\Form;

class ResponsesPerFields extends ChartWidget
{
    public Form $record;

    protected static ?string $maxHeight = '300px';

    protected int | string | array $columnSpan = [
        'lg' => 1,
        'md' => 2,
    ];

    protected static ?array $options = [
        'scales' => [
            'y' => [
                'grid' => [
                    'display' => false,
                ],
                'ticks' => [
                    'display' => false,
                ],
            ],
            'x' => [
                'grid' => [
                    'display' => false,
                ],
                'ticks' => [
                    'display' => false,
                ],
            ],
        ],
    ];

    protected function getType(): string
    {
        return 'pie';
    }

    public function getHeading(): string
    {
        return __('Responses Entries');
    }

    protected function getData(): array
    {
        $dataset = [];

        $form = BoltPlugin::getModel('Form')::query()
            ->with(['fields', 'fieldsResponses'])
            ->where('id', $this->record->id)
            ->first();

        $fields = $form->fields;
        foreach ($fields as $field) {
            $dataset[] = $form->fieldsResponses
                ->where('field_id', $field->id)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => __('entries per month'),
                    'data' => $dataset,
                    'backgroundColor' => '#8A8AFF',
                    'borderColor' => '#ffffff',
                ],
            ],

            'labels' => $fields->pluck('name'),
        ];
    }
}
