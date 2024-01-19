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
        Schema::create(config('zeus-thunder.table-prefix').'offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('slug');
            $table->text('form_ids')->nullable();
            $table->text('faq_ids')->nullable();
            $table->longText('description')->nullable();
            $table->longText('options')->nullable();
            $table->unsignedInteger('ordering')->default(1);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists(config('zeus-thunder.table-prefix').'offices');
    }
};
