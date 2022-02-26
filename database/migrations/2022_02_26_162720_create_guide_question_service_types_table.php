<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\GuideQuestion;
use \App\Models\ServiceType;

class CreateGuideQuestionServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_question_service_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(GuideQuestion::class)->constrained();
            $table->foreignIdFor(ServiceType::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guide_question_service_types');
    }
}
