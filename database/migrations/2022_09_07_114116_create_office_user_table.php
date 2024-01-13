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
        Schema::create(config('zeus-thunder.table-prefix').'office_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('office_id')->constrained(config('zeus-thunder.table-prefix').'offices');
            $table->foreignId('user_id')->constrained('users');
            $table->text('permissions'); // change_status,change_priority,manage_escalated,reply
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
        Schema::dropIfExists(config('zeus-thunder.table-prefix').'office_user');
    }
};
