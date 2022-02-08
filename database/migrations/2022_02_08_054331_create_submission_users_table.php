<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_deceased');
            $table->boolean('is_submitter');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name');
            $table->boolean('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submission_users');
    }
}
