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
        Schema::create(config('zeus-athena.table-prefix') . 'requests_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained(config('zeus-athena.table-prefix') . 'services');
            $table->foreignId('request_id')->constrained(config('zeus-athena.table-prefix') . 'requests');
            $table->string('appointment');
            $table->date('appointment_date')->virtualAs('cast(`appointment` as date)');
            $table->time('appointment_time')->virtualAs('cast(`appointment` as time)');
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
        Schema::dropIfExists(config('zeus-athena.table-prefix') . 'requests_periods');
    }
};
