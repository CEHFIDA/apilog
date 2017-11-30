<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableApiLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('api_logs'))
        {
            Schema::create('api_logs', function(Blueprint $table){
               $table->increments('id');
               $table->text('token');
               $table->string('method', 5);
               $table->string('ip', 50);
               $table->text('url');
               $table->text('data');
               $table->integer('status');
               $table->text('answer');
               $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_logs');
    }
}