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
        Schema::table('seller_activities', function (Blueprint $table) {
            $table->timestamp('updated_at')->nullable(); // Add updated_at column
        });//
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_activities', function (Blueprint $table) {
            $table->dropColumn('updated_at')->nullable(); // Add updated_at column
        });  //
        
    }
};