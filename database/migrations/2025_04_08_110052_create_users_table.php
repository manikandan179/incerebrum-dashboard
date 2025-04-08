<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name', 191);
            $table->string('email', 191)->unique();
            $table->string('phone', 191)->nullable();
            $table->string('password', 191);
            $table->enum('role', ['ADMIN', 'STUDENT'])->default('STUDENT');
            $table->dateTime('created_at', 3)->default(DB::raw('CURRENT_TIMESTAMP(3)'));
            $table->dateTime('updated_at', 3);
            $table->softDeletes('deleted_at', 3); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
