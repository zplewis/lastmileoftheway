<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\FAQCategories;

class CreateFAQQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_a_q_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Identifiers in MySQL are (mostly) limited to 64 characters
            // https://dev.mysql.com/doc/refman/8.0/en/identifier-length.html
            $table->foreignIdFor(FAQCategories::class)->constrained();
            $table->string('description');
            $table->integer('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_a_q_questions');
    }
}
