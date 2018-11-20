<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Role::class)->create([ 'id' => 1,'name' => 'admin', 'display'=>'Менеджер']);
        factory(\App\Models\Role::class)->create([ 'id' => 2,'name' => 'user', 'display'=>'Клиент']);
    }
}
