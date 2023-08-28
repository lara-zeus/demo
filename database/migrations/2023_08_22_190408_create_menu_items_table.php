<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\LaraZeus\Hermes\Models\MenuSection::class);
            $table->string('name');
            $table->string('description')->nullable();
            $table->text('prices')->nullable();
            $table->text('images')->nullable();
            $table->boolean('sort')->default(0);
            $table->integer('calories')->nullable();
            $table->text('labels')->nullable();
            $table->boolean('is_pinned')->default(0);
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
        Schema::dropIfExists('menu_items');
    }
}
