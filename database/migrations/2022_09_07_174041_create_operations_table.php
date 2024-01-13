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
        Schema::create(config('zeus-thunder.table-prefix').'operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('ticket_id')->constrained(config('zeus-thunder.table-prefix').'tickets');
            $table->foreignId('office_id')->constrained(config('zeus-thunder.table-prefix').'offices');
            $table->foreignId('from_office_id')->constrained(config('zeus-thunder.table-prefix').'offices');
            $table->foreignId('user_id')->constrained('users');
            $table->string('action');
            $table->string('operation', 50)->nullable(); //todo for what?
            $table->text('notes')->nullable();
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
        Schema::dropIfExists(config('zeus-thunder.table-prefix').'operations');
    }
};
