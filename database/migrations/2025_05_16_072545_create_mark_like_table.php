<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use LaraZeus\Mark\Facades\Mark;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create((new (Mark::getLikeMorphPivotModel()))->getTable(), function (Blueprint $table) {
            $table->id();
            $table->foreignId('marker_id')
                ->constrained((new (Mark::getMarkerModel()))->getTable())
                ->cascadeOnUpdate();
            $table->morphs('markable');
            $table->string('value');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->unique(['marker_id', 'markable_type', 'markable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists((new (Mark::getLikeMorphPivotModel()))->getTable());
    }
};
