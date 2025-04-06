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
        Schema::create('complaints_suggestions', function (Blueprint $table) {
			$table->increments('complainant_Id');
			$table->string('name'); // complainant's name
			$table->string('phone_email'); // complainant's phone number
			$table->text('content'); // complaint/suggestion text
			$table->boolean('is_public')->default(false);
			$table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
			$table->enum('type', ['complaint','complaint_user','complaint_car', 'suggestion']);
			$table->unsignedInteger('car_Id')->nullable(); //  'car'
			$table->unsignedInteger('user_Id')->nullable(); // user 
			$table->foreign('user_Id')
					  ->references('user_Id')
					  ->on('users')
					  ->nullable()
					  ->onUpdate('cascade')
					  ->onDelete('cascade');
			
			$table->foreign('car_Id')
					  ->references('car_Id')
					  ->on('cars')
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
        Schema::dropIfExists('complaints_suggestions');
		$table->dropForeign('complaints_suggestions_users_id_foreign');
		$table->dropForeign('complaints_suggestions_cars_id_foreign');
    }
};
