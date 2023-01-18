<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_memos', function (Blueprint $table) {
            $table->id();
            $table->integer('memo_id');
            $table->foreign('memo_id')->references('id')->on('memos');
            $table->integer('odependency_id');
            $table->foreign('odependency_id')->references('id')->on('dependencies');
            $table->integer('ddependency_id');
            $table->foreign('ddependency_id')->references('id')->on('dependencies');
            $table->timestamp('date_entry');
            $table->timestamp('date_exit');
            $table->string('obs');
            $table->integer('state_id');
            $table->foreign('state_id')->references('id')->on('states');
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
        Schema::dropIfExists('detail_memos');
    }
}
