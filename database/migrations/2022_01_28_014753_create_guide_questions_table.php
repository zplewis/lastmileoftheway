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
            $table->integer('item_order');
            // If HTML is included here, display it as the text for a switch indicating that this
            // guide question can be excluded from the service if desired
            $table->string('optional')->nullable();
            $table->string('optional_html_id')->nullable();
            $table->string('description', 2500)->nullable();
            $table->string('default_value')->nullable();
            // Text for a button to allow moving forward without submitting the form
            $table->string('advance_no_save_btn_text')->nullable();
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
