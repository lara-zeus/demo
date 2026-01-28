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

                    if (! isset($filters['tableSortColumn'])) {
                        continue;
                    }
                    
                    $filters['tableSort'] = $filters['tableSortColumn'] . ':' . ($filters['tableSortDirection'] ?? 'asc');

                    unset($filters['tableSortColumn'], $filters['tableSortDirection']);

                    DB::table('filament_filter_sets')
                        ->where('id', $record->id)
                        ->update(['filters' => json_encode($filters)]);
                }
            });
    }
};