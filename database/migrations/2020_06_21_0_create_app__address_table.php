<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppAddressTable extends Migration
{
    public function up()
    {
        Schema::connection('pgsql-app')->create('address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('app.locations');
            $table->string('main_street')->nullable();
            $table->string('secondary_street')->nullable();
            $table->string('number')->nullable()->comment('número de casa');
            $table->string('post_code')->nullable()->comment('código postal');
//            $table->foreignId('district')->constrained('app.circuits');/*revizar si es fk */
            $table->text('sector')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('pgsql-app')->dropIfExists('address');
    }

}
