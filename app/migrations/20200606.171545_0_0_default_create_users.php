<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault96549f70d1980f04209c98a5c02ab128 extends Migration
{
    protected const DATABASE = 'default';

    public function up()
    {
        $this->table('users')
            ->addColumn('id', 'primary', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('name', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 255
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down()
    {
        $this->table('users')->drop();
    }
}
