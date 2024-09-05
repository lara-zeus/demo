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
        Schema::create(config('zeus-delia.table-prefix') . 'bookmarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url');
            $table->text('title');
            $table->string('icon');
            $table->integer('user_id');

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
        Schema::dropIfExists(config('zeus-delia.table-prefix') . 'bookmarks');
    }
};
