<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\BibleVersions;
use \App\Models\BibleBook;

class CreateScripturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scriptures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(BibleBook::class)->constrained();
            $table->foreignIdFor(BibleVersions::class)->constrained();
            $table->string('location');
            $table->string('verses', 2500)->nullable();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scriptures');
    }
}
