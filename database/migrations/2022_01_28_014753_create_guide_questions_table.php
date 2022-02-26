<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\GuideCategory;

class CreateGuideQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(GuideCategory::class)->constrained();
            $table->string('title');
            $table->string('uri');
            $table->integer('order');
            // If non-zero, shows a switch to indicate whether this service part is optional
            $table->boolean('optional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guide_questions');
    }
}
