<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('filament_filter_sets')
            ->whereNotNull('filters')
            ->chunkById(100, function ($records) {
                foreach ($records as $record) {
                    $filters = json_decode($record->filters, true);
                    
                    if (! isset($filters['tableColumns']) || empty($filters['tableColumns'])) {
                        continue;
                    }
                    
                    $firstColumn = $filters['tableColumns'][0];
                    
                    if (isset($firstColumn['isHidden']) && isset($firstColumn['isToggledHiddenByDefault'])) {
                        continue;
                    }
                    
                    foreach ($filters['tableColumns'] as &$column) {
                        $column['isHidden'] = false;
                        $column['isToggledHiddenByDefault'] = false;
                    }
                    
                    DB::table('filament_filter_sets')
                        ->where('id', $record->id)
                        ->update(['filters' => json_encode($filters)]);
                }
            });
    }
};