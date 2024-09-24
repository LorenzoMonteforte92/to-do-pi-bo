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
        Schema::create('new_profile_organiser', function (Blueprint $table) {
            $table->unsignedBigInteger('new_profile_id');
            $table->foreign('new_profile_id')
            ->references('id')
            ->on('new_profiles')
            ->onDelete('cascade');

            $table->unsignedBigInteger('organiser_id');
            $table->foreign('organiser_id')
            ->references('id')
            ->on('organisers')
            ->onDelete('cascade');

            $table->primary(['new_profile_id', 'organiser_id']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_profile_organiser');
    }
};
