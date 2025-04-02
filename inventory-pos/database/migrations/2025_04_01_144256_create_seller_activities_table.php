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
        Schema::create('seller_activities', function (Blueprint $table) {
            $table->id();
            // Foreign key linking to users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Activity type (e.g., 'login', 'logout', 'product_added', etc.)
            $table->string('activity_type');
            // Foreign key linking to products table (nullable, for activities not involving products)
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            // Timestamp for when the activity was created (defaults to the current timestamp)
            $table->timestamp('created_at')->useCurrent();
            
            // Optional: Index user_id for faster lookups by user
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_activities');
    }
};