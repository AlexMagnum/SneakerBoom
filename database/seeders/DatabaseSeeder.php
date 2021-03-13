<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
        // Заповнення таблиць випадковими значеннями
        \App\Models\User::factory(10)->create();
        \App\Models\Newsletter::factory(10)->create();
        \App\Models\Contact::factory(10)->create();

       // Створення ролів та дозволів
      app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'editor goods']);
        Permission::create(['name' => 'editor orders']);
        Permission::create(['name' => 'editor users']);
        Permission::create(['name' => 'editor ui']);
        Permission::create(['name' => 'editor contacts']);
        Permission::create(['name' => 'editor rss']);

        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo([
            'editor goods',
            'editor orders',
            'editor users',
            'editor ui',
            'editor contacts',
            'editor rss'
            ]);

        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo([
            'editor goods',
            'editor orders',
        ]);

        $role3 = Role::create(['name' => 'redactor']);
        $role3->givePermissionTo([
            'editor ui',
            'editor contacts',
            'editor rss'
        ]);

        $role = Role::create(['name' => 'user']);
*/
        $user = User::where('id', 11)->first();
        $user->assignRole('admin');


    }
}
