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
        Schema::create('organiser_new_profile', function (Blueprint $table) {
            $table->unsignedBigInteger('organiser_id');
            $table->foreign('organiser_id')
            ->references('id')
            ->on('organisers')
            ->onDelete('cascade');

            $table->unsignedBigInteger('new_profile_id');
            $table->foreign('new_profile_id')
            ->references('id')
            ->on('new_profiles')
            ->onDelete('cascade');

            $table->primary(['organiser_id', 'new_profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organiser_new_profile');
    }
};
