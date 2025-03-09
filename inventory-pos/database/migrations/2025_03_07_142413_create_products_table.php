<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_category', 100)->nullable();
            $table->string('product_brand', 100)->nullable();
            $table->string('product_sku')->unique();
            $table->string('barcode')->nullable();
            $table->string('unit_of_measure', 50)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('minimum_stock_level')->default(0);
            $table->integer('reorder_quantity')->default(0);
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('discount', 5, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(0);
            $table->enum('product_status', ['active', 'discontinued', 'out_of_stock'])->default('active');
            $table->date('expiry_date')->nullable();
            $table->timestamps(); // This will create `created_at` and `updated_at` columns
            $table->softDeletes(); // This will create a `deleted_at` column for soft deletes

            // Foreign keys
            $table->unsignedBigInteger('added_by')->nullable();
$table->foreign('added_by')->references('id')->on('users')->onDelete('set null');

$table->unsignedBigInteger('last_updated_by')->nullable();
$table->foreign('last_updated_by')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
} 