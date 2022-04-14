<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tickets", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->enum("status", ["instantaneous", "normal", "nonsignificant"]);
            $table->integer("code");
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->on("users")->references("id")
                ->onDelete("cascade");
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
        Schema::dropIfExists("tickets");
    }
}
