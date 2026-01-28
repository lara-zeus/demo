<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('filament_filter_sets')
            ->whereNotNull('filters')
            ->chunkById(100, function ($records) {
                foreach ($records as $record) {
                    $filters = json_decode($record->filters, true);
                    
                    if (! is_array($filters)) {
                        continue;
                    }

                    $tableColumns = $this->transformTableColumns($filters);
                    
                    if (empty($tableColumns)) {
                        continue;
                    }

                    unset($filters['orderedToggledTableColumns'], $filters['toggledTableColumns']);
                    $filters['tableColumns'] = $tableColumns;

                    DB::table('filament_filter_sets')
                        ->where('id', $record->id)
                        ->update(['filters' => json_encode($filters)]);
                }
            });
    }

    protected function transformTableColumns(array $filters): array
    {
        if (isset($filters['orderedToggledTableColumns'])) {
            return $this->transformOrderedToggledColumns(
                $filters['orderedToggledTableColumns'],
                $filters['toggledTableColumns'] ?? []
            );
        }

        if (isset($filters['toggledTableColumns'])) {
            return $this->transformToggledTableColumns($filters['toggledTableColumns']);
        }

        return [];
    }

    protected function transformOrderedToggledColumns(array $orderedColumns, array $toggledColumns = []): array
    {
        if ($this->isStoredAsArray($orderedColumns)) {
            return collect($orderedColumns)
                ->map(fn (array $item): array => [
                    'type' => 'column',
                    'name' => $item['column'],
                    'label' => $item['column'],
                    'isHidden' => false,
                    'isToggled' => $item['isVisible'],
                    'isToggleable' => true,
                    'isToggledHiddenByDefault' => false,
                ])
                ->values()
                ->toArray();
        }

        if ($this->isStoredAsOrder($orderedColumns)) {
            $dottedToggledColumns = empty($toggledColumns) ? [] : Arr::dot($toggledColumns);

            $orderedColumnsCollection = collect($orderedColumns)
                ->keys()
                ->map(fn (string $column): array => [
                    'type' => 'column',
                    'name' => $column,
                    'label' => $column,
                    'isHidden' => false,
                    'isToggled' => $dottedToggledColumns[$column] ?? true,
                    'isToggleable' => true,
                    'isToggledHiddenByDefault' => false,
                ]);

            $missingColumns = collect($dottedToggledColumns)
                ->keys()
                ->diff($orderedColumnsCollection->pluck('name'))
                ->map(fn (string $column): array => [
                    'type' => 'column',
                    'name' => $column,
                    'label' => $column,
                    'isHidden' => false,
                    'isToggled' => $dottedToggledColumns[$column],
                    'isToggleable' => true,
                    'isToggledHiddenByDefault' => false,
                ]);

            return $orderedColumnsCollection
                ->concat($missingColumns)
                ->values()
                ->toArray();
        }

        if ($this->isStoredAsBool($orderedColumns)) {
            return collect($orderedColumns)
                ->map(fn (bool $isToggled, string $column): array => [
                    'type' => 'column',
                    'name' => $column,
                    'label' => $column,
                    'isHidden' => false,
                    'isToggled' => $isToggled,
                    'isToggleable' => true,
                    'isToggledHiddenByDefault' => false,
                ])
                ->values()
                ->toArray();
        }

        return [];
    }

    protected function transformToggledTableColumns(array $toggledColumns): array
    {
        $flattened = Arr::dot($toggledColumns);

        return collect($flattened)
            ->map(fn (bool $isToggled, string $column): array => [
                'type' => 'column',
                'name' => $column,
                'label' => $column,
                'isToggled' => $isToggled,
                'isToggleable' => true,
            ])
            ->values()
            ->toArray();
    }

    protected function isStoredAsArray(array $data): bool
    {
        if (empty($data) || ! is_array($data[0] ?? null)) {
            return false;
        }

        return isset($data[0]['column']) && isset($data[0]['isVisible']);
    }

    protected function isStoredAsOrder(array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        return collect($data)
            ->every(fn ($value): bool => ! is_bool($value));
    }

    protected function isStoredAsBool(array $data): bool
    {
        if (empty($data)) {
            return false;
        }

        return collect($data)
            ->every(fn ($value): bool => is_bool($value));
    }
};