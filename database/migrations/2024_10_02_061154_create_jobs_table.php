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
            $table->unsignedBigInteger('work_location_id');
            $table->string('spesifikasi');
            $table->unsignedBigInteger('department');
            $table->string('employment_type');
            $table->decimal('minimum_salary', 10, 2);
            $table->decimal('maximum_salary', 10, 2);
            $table->text('benefit');
            $table->text('responsibilities');
            $table->text('requirements');
            $table->boolean('status_published')->default(0); // Nilai default 0 (Unpublished)
            $table->timestamps();
            $table->foreign('department')->references('id')->on('departements')->onDelete('cascade');
            $table->foreign('work_location_id')->references('id')->on('work_location')->onDelete('cascade');

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