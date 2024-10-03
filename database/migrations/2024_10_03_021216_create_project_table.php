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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id'); // Foreign key column
            $table->string('project_name');
            $table->text('desc_project');
            $table->string('client');
            $table->date('mulai_project');
            $table->date('selesai_project');
            $table->timestamps();
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
};
