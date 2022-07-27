<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('authors')->onDelete('cascade');
            $table->foreignId('source_id')->nullable()->constrained('sources');
            $table->foreignId('reaction_id')->nullable()->constrained('reactions')->onDelete('cascade');
            $table->string('url');
            $table->string('type')->default('post');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
