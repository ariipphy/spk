<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelanggaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama_siswa'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'frekuensi'     => ['type' => 'INT'],
            'tingkat'       => ['type' => 'INT'],
            'dampak'        => ['type' => 'INT'],
            'kesengajaan'   => ['type' => 'INT'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggaran');
    }
}
