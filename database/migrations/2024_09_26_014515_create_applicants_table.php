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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id'); // Foreign key column
            $table->string('name');
            $table->text('address');
            $table->string('number');
            $table->string('email');
            $table->string('profil_linkedin')->nullable();
            $table->string('portfolio')->nullable();
            $table->string('certificates');
            $table->string('education');
            $table->string('experience');
            $table->string('photo_pass');
            $table->text('profile');
            $table->text('languages');
            $table->text('skills');
            $table->decimal('salary_expectation', 10, 2);
            $table->enum('status', ['applied', 'interview', 'offer', 'accepted', 'rejected'])->default('applied');

            $table->timestamps();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
};
