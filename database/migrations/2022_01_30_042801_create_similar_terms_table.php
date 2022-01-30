<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Definitions;

class CreateSimilarTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('similar_terms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Definitions::class)->constrained();
            $table->foreignId('similar_id');
            $table->foreign('similar_id')->references('id')->on('definitions')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('similar_terms');
    }
}
