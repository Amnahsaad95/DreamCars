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
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('car_Id');
			$table->string('car_Name');
							  
			$table->integer('car_Model_Year');
			$table->decimal('car_Price', 10, 2);
			$table->enum('car_Fuel_Type', ['Gasoline', 'Diesel', 'electricity']);
			$table->enum('car_Transmission', ['Manual', 'automatic']);
			$table->string('car_Image')->nullable();
			$table->text('car_Description')->nullable();
			$table->unsignedInteger('brand_Id');
			$table->foreign('brand_Id')
				  ->references('brand_Id')
				  ->on('brands')
				  ->nullable()
				  ->onUpdate('cascade')
				  ->onDelete('cascade');
			$table->timestamps();

        });
		Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
		$table->dropForeign('cars_brands_id_foreign');
    }
};
