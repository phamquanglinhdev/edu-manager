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
        Schema::create('student_sup', function (Blueprint $table) {
            $table->unsignedBigInteger("student_id");
            $table->foreign("student_id")->references("id")->on("users");
            $table->unsignedBigInteger("sup_id");
            $table->foreign("sup_id")->references("id")->on("sups");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_sup');
    }
};
