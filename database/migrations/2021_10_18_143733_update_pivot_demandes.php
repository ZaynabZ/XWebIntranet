<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePivotDemandes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demande_user', function (Blueprint $table) {
            $table->enum('etat', ['En cours', 'Réalisée'])->default('En cours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demande_user', function (Blueprint $table) {
            $table->dropColumn('etat');
        });
    }
}
