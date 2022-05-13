<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->comment('usersプライマリー');
            $table->text('contents')->comment('目標内容');
            $table->smallInteger('status')->default(10)->comment('ステータス');
            $table->float('total_score')->default(0)->comment('合計スコア');
            $table->dateTime('expiration_date')->comment('期限日');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targets');
    }
};
