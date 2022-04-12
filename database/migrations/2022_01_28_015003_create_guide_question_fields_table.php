<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\GuideQuestion;

class CreateGuideQuestionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_question_fields', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(GuideQuestion::class)->constrained();
            // $table->foreignIdFor(GuideFieldType::class)->constrained();
            $table->string('html_id');
            $table->string('label')->nullable();
            $table->string('validation')->nullable();
            $table->string('field_css')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guide_question_fields');
    }
}
