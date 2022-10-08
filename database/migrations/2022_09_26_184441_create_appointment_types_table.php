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
        Schema::create('appointment_types', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();

            $table->foreign('appointment_id')
                ->references('id')
                ->on('appointments')
                ->cascadeOnDelete();

            $table->foreign('type_id')
                ->references('id')
                ->on('types')
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
        Schema::dropIfExists('appointment_types');
    }
};
