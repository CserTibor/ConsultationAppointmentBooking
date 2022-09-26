<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('publisher_id');
            $table->unsignedBigInteger('holder_id');
            $table->timestamps();

            $table->foreign('publisher_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('holder_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('appointment_id')
                ->references('id')
                ->on('appointments')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_appointments');
    }
};
