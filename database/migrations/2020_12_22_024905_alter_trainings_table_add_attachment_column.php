<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTrainingsTableAddAttachmentColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings', function(Blueprint $table) {
            $table->string('attachment')->nullable()->after('trainer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            //migrate rollback
        Schema::table('trainings', function(Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }
}
