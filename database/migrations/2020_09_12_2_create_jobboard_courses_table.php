<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobboardCoursesTable extends Migration
{

    public function up()
    {
        Schema::connection('pgsql-job-board')->create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professional_id');
            $table->foreignId('event_type_id')->constrained('app.catalogues');
            $table->foreignId('institution_id')->constrained('app.catalogues');
            $table->foreignId('certification_type_id')->constrained('app.catalogues');
            $table->string('event_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('hours');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::connection('pgsql-job-board')->dropIfExists('courses');
    }
}
