<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    public function up()
    {
        Schema::connection('pgsql-web')->create('resources', function (Blueprint $table) {
            $table->id();
            $table->morphs('resourceable');
            $table->text('url');
            $table->text('name');
            $table->text('description');
            $table->integer('order');
            $table->foreignId('type_id')->constrained('app.catalogues');
            $table->foreignId('status_id')->constrained('app.catalogues');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('pgsql-web')->dropIfExists('resources');
    }
}
