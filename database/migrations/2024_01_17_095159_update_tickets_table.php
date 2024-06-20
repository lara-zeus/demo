<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(config('zeus-thunder.table-prefix') . 'tickets', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id']);
            $table->dateTime('escalated_at')->nullable();
        });

        Schema::table(config('zeus-thunder.table-prefix') . 'operations', function (Blueprint $table) {
            $table->foreignId('from_office_id')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(config('zeus-thunder.table-prefix') . 'tickets', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained(config('zeus-bolt.table-prefix') . 'categories')->nullOnDelete();
            $table->dropColumn('escalated_at');
        });
    }
};
