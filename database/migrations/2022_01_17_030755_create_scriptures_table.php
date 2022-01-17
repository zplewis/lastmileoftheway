<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\BibleVersions;
use \App\Models\Testaments;

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
            $table->foreignIdFor(Testaments::class)->constrained();
            $table->foreignIdFor(BibleVersions::class)->constrained();
            $table->string('description');
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
