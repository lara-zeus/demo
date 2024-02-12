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
        Schema::create(config('zeus-athena.table-prefix') . 'services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained(config('zeus-bolt.table-prefix').'categories')->nullOnDelete();
            $table->foreignId('form_id')->nullable()->constrained(config('zeus-bolt.table-prefix').'forms')->nullOnDelete();

            $table->text('name');
            $table->string('slug');
            $table->string('color')->nullable();
            $table->text('description')->nullable();

            $table->integer('slots_period_minutes')->default(5);
            $table->integer('min_time_slots')->default(1);
            $table->integer('max_time_slots')->default(1);
            $table->integer('req_per_slot')->default(1);
            $table->integer('allow_multiple')->default(0);
            $table->integer('days_to_req')->default(30);
            $table->integer('days_before_req')->default(0);
            $table->integer('days_between_requests')->default(0);
            $table->integer('hours_to_cancel')->default(24);
            $table->integer('ordering')->default(1);
            $table->string('req_acceptance_mode')->default('AUTO'); //MANUAL
            $table->text('timetable');
            $table->boolean('is_request_user_unique')->default(true);
            $table->text('notifications')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_multi_day')->default(false);
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->text('options')->nullable();
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
        Schema::dropIfExists(config('zeus-athena.table-prefix') . 'services');
    }
};
