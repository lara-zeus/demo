<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('zeus-athena.table-prefix') . 'tmp_time_lock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained(config('zeus-athena.table-prefix').'services')->nullOnDelete();
            $table->dateTime('appointment');
            $table->dateTime('start_time_lock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('zeus-athena.table-prefix') . 'tmp_time_lock');
    }
};
