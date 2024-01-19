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
        Schema::create(config('zeus-thunder.table-prefix').'tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_no', 20);

            $table->foreignId('office_id')->constrained(config('zeus-thunder.table-prefix').'offices');
            $table->foreignId('category_id')->nullable()->constrained(config('zeus-bolt.table-prefix').'categories')->nullOnDelete();
            $table->foreignId('response_id')->nullable()->constrained(config('zeus-bolt.table-prefix').'responses')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('assignee_id')->nullable()->constrained('users'); // todo multiple?

            $table->string('status')->default('OPEN');
            $table->string('priority')->default('NORMAL');

            $table->string('subject', 200)->nullable();
            $table->longText('content')->nullable();

            $table->tinyInteger('is_escalated')->nullable()->default(0);

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
        Schema::dropIfExists(config('zeus-thunder.table-prefix').'tickets');
    }
};
