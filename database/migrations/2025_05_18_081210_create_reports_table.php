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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('resident_id')->references('id')->on('residents')->onDelete('RESTRICT');
            $table->foreignId('report_category_id')->references('id')->on('report_categories')->onDelete('RESTRICT');
            $table->string('title');
            $table->longText('description')->default(NULL);
            $table->string('image');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
