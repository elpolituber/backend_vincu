<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthUsersTable extends Migration
{
    public function up()
    {
        Schema::connection('pgsql-authentication')->create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ethnic_origin_id')->nullable()->constrained('app.catalogues');
            $table->foreignId('address_id')->nullable()->constrained('app.address');
            $table->foreignId('identification_type_id')->nullable()->constrained('app.catalogues');
            $table->foreignId('sex_id')->nullable()->constrained('app.catalogues');
            $table->foreignId('gender_id')->nullable()->constrained('app.catalogues');
            $table->boolean('state')->default(true);
            $table->foreignId('status_id')->constrained('app.status');;
            $table->foreignId('blood_type_id')->nullable()->constrained('app.catalogues');
            $table->foreignId('civil_status_id')->nullable()->constrained('app.catalogues');
            $table->string('avatar')->nullable()->unique();
            $table->string('security_image')->nullable();
            $table->string('username', 50)->unique();
            $table->string('identification', 20);
            $table->string('first_name', 1000)->nullable();
            $table->string('second_name', 100)->nullable();
            $table->string('first_lastname', 100)->nullable();
            $table->string('second_lastname', 100)->nullable();
            $table->string('personal_email', 100)->nullable()->unique();
            $table->date('birthdate')->nullable();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('change_password')->default(false);
            $table->integer('attempts')->default(\App\Models\Authentication\User::ATTEMPTS);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::connection('pgsql-authentication')->dropIfExists('users');
    }
}
