<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->integer('odependency_id');
            $table->foreign('odependency_id')->references('id')->on('dependencies');
            $table->string('number_memo');
            $table->string('ref');
            $table->string('obs');
            $table->date('date_doc');
            $table->timestamp('date_entry');
            $table->timestamp('date_exit');
            $table->integer('ddependency_id');
            $table->foreign('ddependency_id')->references('id')->on('dependencies');
            $table->integer('admin_user_id');
            $table->foreign('admin_user_id')->references('id')->on('admin_users');
            $table->integer('state_id');
            $table->foreign('state_id')->references('id')->on('states');
            $table->integer('type_id');
            $table->foreign('type_id')->references('id')->on('doc_types');

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
        Schema::dropIfExists('memos');
    }
}
