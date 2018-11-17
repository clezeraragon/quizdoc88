<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePivotTopicXProof extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics_x_proofs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_proof')->unsigned();
            $table->integer('id_topic')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['deleted_at']);

            $table->foreign('id_proof')->references('id')->on('proofs');
            $table->foreign('id_topic')->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics_x_proofs');
    }
}
