<?php namespace MightyCode\Autoscout24Adapter\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCarInfosTable extends Migration
{

    public function up()
    {
        Schema::create('mightycode_autoscout24adapter_car_infos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->string('color');
            $table->string('age_group');
            $table->string('mileage');
            $table->string('price');
            $table->string('imageUrl');
            $table->string('detailUrl');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mightycode_autoscout24adapter_car_infos');
    }

}
