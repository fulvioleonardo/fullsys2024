<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\DB;
>>>>>>> bd1041e (tirilla acomodado factura electronica)

class AddIndexesToDocuments extends Migration
{
    /**
<<<<<<< HEAD
=======
     * Verifica si hay duplicados en una tabla para ciertas columnas.
     *
     * @param string $table
     * @param array $columns
     * @return bool
     */
    private function hasDuplicates($table, $columns)
    {
        $query = DB::table($table)
            ->select($columns)
            ->selectRaw('COUNT(*) as total')
            ->groupBy($columns)
            ->havingRaw('COUNT(*) > 1')
            ->limit(1)
            ->get();

        // Si se encuentran duplicados, retorna true
        return $query->isNotEmpty();
    }

    /**
     * Verifica si un índice existe en una tabla.
     *
     * @param string $tableName
     * @param string $indexName
     * @return bool
     */
    private function indexExists($tableName, $indexName)
    {
        $sm = Schema::getConnection()->getDoctrineSchemaManager();
        $indexes = $sm->listTableIndexes($tableName);

        return array_key_exists($indexName, $indexes);
    }

    /**
>>>>>>> bd1041e (tirilla acomodado factura electronica)
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::table('documents', function (Blueprint $table) {
            $table->unique(['type_document_id', 'type_environment_id', 'prefix', 'number'], 'environment_prefix_number_unique');
        });

        Schema::table('documents_pos', function (Blueprint $table) {
            $table->unique(['filename', 'prefix', 'number'], 'filename_prefix_number_unique');
        });
=======
        // Para la tabla 'documents'
        if (!$this->indexExists('documents', 'environment_prefix_number_unique') &&
            !$this->hasDuplicates('documents', ['type_document_id', 'type_environment_id', 'prefix', 'number'])) {

            Schema::table('documents', function (Blueprint $table) {
                $table->unique(['type_document_id', 'type_environment_id', 'prefix', 'number'], 'environment_prefix_number_unique');
            });
        }

        // Para la tabla 'documents_pos'
        if (!$this->indexExists('documents_pos', 'filename_prefix_number_unique') &&
            !$this->hasDuplicates('documents_pos', ['filename', 'prefix', 'number'])) {

            Schema::table('documents_pos', function (Blueprint $table) {
                $table->unique(['filename', 'prefix', 'number'], 'filename_prefix_number_unique');
            });
        }
>>>>>>> bd1041e (tirilla acomodado factura electronica)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD
        Schema::table('documents', function (Blueprint $table) {
            $table->dropUnique('environment_prefix_number_unique');
        });

        Schema::table('documents_pos', function (Blueprint $table) {
            $table->dropUnique('filename_prefix_number_unique');
        });
=======
        // Para la tabla 'documents'
        if ($this->indexExists('documents', 'environment_prefix_number_unique')) {
            Schema::table('documents', function (Blueprint $table) {
                $table->dropUnique('environment_prefix_number_unique');
            });
        }

        // Para la tabla 'documents_pos'
        if ($this->indexExists('documents_pos', 'filename_prefix_number_unique')) {
            Schema::table('documents_pos', function (Blueprint $table) {
                $table->dropUnique('filename_prefix_number_unique');
            });
        }
>>>>>>> bd1041e (tirilla acomodado factura electronica)
    }
}
