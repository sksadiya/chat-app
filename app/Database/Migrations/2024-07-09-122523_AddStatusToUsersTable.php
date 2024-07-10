<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Online', 'Offline'], // Define allowed status values
                'default' => 'offline',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'status');
    }
}
