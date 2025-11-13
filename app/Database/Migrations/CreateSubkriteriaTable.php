namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubkriteriaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'auto_increment' => true],
            'id_kriteria'       => ['type' => 'INT'],
            'nama_subkriteria'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'nilai'             => ['type' => 'FLOAT'],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_kriteria', 'kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('subkriteria');
    }

    public function down()
    {
        $this->forge->dropTable('subkriteria');
    }
}
