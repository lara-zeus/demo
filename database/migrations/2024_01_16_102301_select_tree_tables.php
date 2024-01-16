<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('select_tree_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('select_tree_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('select_tree_categories');
            $table->timestamps();
        });

        Schema::create('select_tree_blog_category', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->foreign('blog_id')->references('id')->on('select_tree_blogs')->cascadeOnDelete();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('select_tree_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('select_tree_blogs');
        Schema::dropIfExists('select_tree_categories');
        Schema::dropIfExists('select_tree_blog_category');
    }
};
