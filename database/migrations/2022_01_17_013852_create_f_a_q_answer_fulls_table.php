<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FAQCategories;
use App\Models\FAQQuestions;

class CreateFAQAnswerFullsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_a_q_answer_fulls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(FAQQuestions::class)->constrained();
            $table->foreignIdFor(FAQCategories::class)->constrained();
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
        Schema::dropIfExists('f_a_q_answer_fulls');
    }
}
