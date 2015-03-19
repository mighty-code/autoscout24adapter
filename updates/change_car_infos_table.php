<?php namespace MightyCode\Autoscout24Adapter\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class ChangeCarInfosTable extends Migration
{

    public function up()
    {
        Schema::table('mightycode_autoscout24adapter_car_infos', function($table)
        {
            $table->dropColumn('color');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mightycode_autoscout24adapter_car_infos');
    }

}
