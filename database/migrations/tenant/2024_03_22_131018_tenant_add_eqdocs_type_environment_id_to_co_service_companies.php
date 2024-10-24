<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantAddEqDocsTypeEnvironmentIdToCoServiceCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('co_service_companies', function (Blueprint $table) {
            $table->unsignedBigInteger('eqdocs_type_environment_id')->after('type_environment_id')->default(2);
            $table->foreign('eqdocs_type_environment_id')->references('id')->on('co_service_type_environments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('co_service_companies', function (Blueprint $table) {
            $table->dropForeign(['eqdocs_type_environment_id']);
            $table->dropColumn('eqdocs_type_environment_id');
        });
    }
}
