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
        Schema::create(config('zeus-chronos.table-prefix') . 'documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variety_id')->nullable()->constrained(config('zeus-chronos.table-prefix') . 'varieties')->nullOnDelete();
            $table->text('name');
            $table->text('file')->nullable();
            $table->longText('attributes_values')->nullable();
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
        Schema::dropIfExists(config('zeus-chronos.table-prefix') . 'documents');
    }
};
