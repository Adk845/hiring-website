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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_name');
            $table->string('work_location');
            $table->string('department');
            $table->string('employment_type');
            $table->decimal('minimum_salary', 10, 2);
            $table->decimal('maximum_salary', 10, 2);
            $table->text('benefit');
            $table->text('responsibilities');
            $table->text('requirements');
            $table->boolean('status_published');
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
        Schema::dropIfExists('jobs');
    }
};
