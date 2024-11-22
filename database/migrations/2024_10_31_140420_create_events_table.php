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
        Schema::create(config('zeus-apollo.table-prefix').'events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->nullable()->constrained(config('zeus-bolt.table-prefix').'forms')->nullOnDelete();

            $table->text('name');
            $table->string('slug');
            $table->text('description')->nullable();

            $table->string('image_cover')->nullable();
            $table->boolean('is_active')->default(1);

            $table->dateTime('event_start');
            $table->dateTime('event_end');

            $table->dateTime('announce_start');
            $table->dateTime('announce_end');

            $table->dateTime('enrolment_start');
            $table->dateTime('enrolment_end');

            $table->text('location');

            // enable
            // allow to cancel
            // allow to cancel before days
            // approval type
            // max enrol
            //
            $table->text('enrol_options');

            $table->text('instructions');
            $table->text('objectives');
            $table->text('requirements');

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
