<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->boolean('approved')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('opening_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                    ->on('users');


            $table->foreign('opening_id')
                ->references('id')
                    ->on('openings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
