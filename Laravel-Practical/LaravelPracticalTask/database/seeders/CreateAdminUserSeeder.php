<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([
            'first_name' => 'Satish', 
            'last_name' => 'Parmar', 
            'gender' => 'male', 
            'phone' => 7574945107, 
            'is_admin'=>'1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
    
        $role = Role::create(['name' => 'Admin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
