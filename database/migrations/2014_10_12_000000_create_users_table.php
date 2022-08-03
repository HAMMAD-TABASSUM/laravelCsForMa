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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('districtId');
            $table->string('profileImage');
            $table->string('districtName');
            $table->string('address');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fullName');
            $table->string('typeSchoolName');
            $table->string('selectRole');
            $table->string('typeEmail');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phoneNumber');
            $table->string('city');
            $table->string('state');
            $table->string('zipCode');
            $table->string('resume');
            $table->string('bio');
            $table->string('semail');
            $table->string('address2');
            $table->string('schoolDistrict');
            $table->string('schoolName');
            $table->string('schoolSetting');
            $table->string('schoolType');
            $table->string('primaryRole');
            $table->string('studentAverage');
            $table->string('primaryArea');
            $table->string('teachingGrades');
            $table->string('programmingExperience');
            $table->string('race');
            $table->string('person');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
