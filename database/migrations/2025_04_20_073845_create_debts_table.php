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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_id')->constrained()->onDelete('cascade');
            $table->foreignId('lender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId(column: 'borrower_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->boolean('is_settled')->default(false);
            $table->dateTime('expense_date')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }//end up()


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }//end down()


};
