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
			$table->string('Brand');							  
			$table->string('car_Model');
			$table->integer('car_Year');
			$table->decimal('car_Price', 10, 2);
			$table->string('car_Image')->nullable();			
			$table->string('city');
			$table->string('country');
			$table->string('color');
			$table->boolean('isSold')->default(false);
			$table->text('car_Description')->nullable();
			$table->unsignedInteger('user_Id');
			$table->foreign('user_Id')
				  ->references('user_Id')
				  ->on('users')
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
		$table->dropForeign('cars_users_id_foreign');
    }
};
