<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$user = User::create([
            'name' => 'Jitesh Meniya', 
            'email' => 'jiteshmeniya99@gmail.com',
            'password' => Hash::make('12345678')
        ]);*/

        $user = User::create([
            'name' => 'admin',
            'email' => 'super_admin@infostride.com',
            'password' => Hash::make('123456'),
        ]);
        $user->assignRole(['admin']);

        $roles = Role::where('name','admin')
                      ->orwhere('name','admin')
                        ->get();

        $permissions = Permission::all();
        
        foreach($roles as $role){
            $role->syncPermissions($permissions);
        }

        /*$role->syncPermissions($permissions);

         
        $role = Role::find(1);

        $permissions = Permission::pluck('id', 'id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);*/
    }
}