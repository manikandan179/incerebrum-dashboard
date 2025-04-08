<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('upskill', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 191);
            $table->string('email', 191);
            $table->string('phone', 191);
            $table->string('message', 191);
            $table->dateTime('created_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3)')); 
            $table->dateTime('updated_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3) ON UPDATE CURRENT_TIMESTAMP(3)')); 
            $table->softDeletes('deleted_at', 3);  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upskill');
    }
};
