<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::connection('pgsql-app')->create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->text('name');
            $table->text('description')->nullable();
            $table->string('value');
            $table->foreignId('type_id')->constrained('catalogues');
            $table->foreignId('status_id')->constrained('catalogues');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('pgsql-app')->dropIfExists('settings');
    }
}
