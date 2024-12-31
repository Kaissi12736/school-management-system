<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration {

	public function up()
	{
		Schema::create('Classrooms', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('Grade_id')->unsigned();
			$table->string('Name_Class');
		});
	}

	public function down()
	{
		Schema::drop('Classrooms');
	}
}