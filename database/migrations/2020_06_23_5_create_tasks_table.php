<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::connection('pgsql-attendance')->create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_id');
            $table->foreignId('type_id')->constrained('app.catalogues');
            $table->boolean('state')->default(true);
            $table->text('description')->nullable();
            $table->unsignedDouble('percentage_advance')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('pgsql-attendance')->dropIfExists('tasks');
    }
}
