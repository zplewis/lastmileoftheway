<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FAQQuestions;

class CreateFAQAnswerShortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_a_q_answer_shorts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(FAQQuestions::class)->constrained();
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_a_q_answer_shorts');
    }
}
