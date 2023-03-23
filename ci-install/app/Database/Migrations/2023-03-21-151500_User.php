<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'unique'        => true        
            ],
            'avatar' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255
            ],
            'verification_status' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'default'       => 'unverified',
                'null'          => true
            ],
            'verification_number' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
                'null'          => true
            ],
            'created_at' => [
                'type'  => 'TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
