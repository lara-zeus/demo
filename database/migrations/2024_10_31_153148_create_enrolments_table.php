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
        Schema::create(config('zeus-apollo.table-prefix').'enrolments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained(config('zeus-apollo.table-prefix').'events')->nullOnDelete();
            $table->foreignId('form_id')->nullable()->constrained(config('zeus-bolt.table-prefix').'forms')->nullOnDelete();
            $table->foreignId('response_id')->nullable()->constrained(config('zeus-bolt.table-prefix').'responses')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('enrol_id');
            $table->string('status');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('zeus-apollo.table-prefix').'events');
    }
};
