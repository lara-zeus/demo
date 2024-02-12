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
        Schema::create(config('zeus-athena.table-prefix') . 'assigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained(config('zeus-athena.table-prefix') . 'services');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('is_manager');
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
        Schema::dropIfExists(config('zeus-athena.table-prefix') . 'assigns');
    }
};
