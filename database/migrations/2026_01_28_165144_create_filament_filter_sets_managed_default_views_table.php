<?php

use Archilex\AdvancedTables\Support\Config;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filament_filter_sets_managed_default_views', function (Blueprint $table) {
            $userClass = Config::getUser();
            $user = new $userClass();

            $table->id();

            $table->foreignId('user_id')->references($user->getKeyName())->on($user->getTable())->constrained()->cascadeOnDelete();
            $table->integer(Config::getTenantColumn())->nullable();
            $table->string('resource');
            $table->string('view_type');
            $table->string('view');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('filament_filter_sets_managed_default_views');
    }
};
