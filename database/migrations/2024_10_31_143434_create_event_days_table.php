<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('zeus-apollo.table-prefix').'event_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained(config('zeus-apollo.table-prefix').'events')->cascadeOnDelete();

            $table->text('name');
            $table->date('day');

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
        Schema::dropIfExists(config('zeus-apollo.table-prefix').'event_days');
    }
};
