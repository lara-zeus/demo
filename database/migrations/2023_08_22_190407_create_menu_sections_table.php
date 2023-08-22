<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\LaraZeus\Hermes\Models\Menu::class);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('cover')->nullable();
            $table->integer('order')->default(1);
            $table->timestamps();
            $table->integer('is_active')->default(1);
            $table->string('cover_focal_point')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_sections');
    }
}
