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
    public function up(): void
    {
        Schema::create('expense_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('role', ['payer', 'participant']);
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->decimal('amount_paid', 10, 2)->default(0.00);
            $table->timestamps();
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['expense_id', 'user_id']);
        });
    }//end up()


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_participants');
    }//end down()


};
