<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
            'firstname' => 'David',
            'lastname' => 'Bowie',
            'username' => 'admin',
            'address' =>'popmatchcomp',
            'email' => 'admin@demo.com',
            'sex' => 'M',
            'password' => bcrypt('12345678')
        ]);

        $role = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'user']);
        $permissions = [
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-list',
            'exercise-create',
            'exercise-edit',
            'exercise-all',
            'exercise-delete'
        ];
        $role2->syncPermissions($permissions);
        Category::create(['name' => 'Acción']);
        Category::create(['name' => 'Aventuras']);
        Category::create(['name' => 'Ficción']);
        Category::create(['name' => 'Terror']);
        Category::create(['name' => 'Suspense']);
        Category::create(['name' => 'Thriller']);
        Category::create(['name' => 'Western']);
        Category::create(['name' => 'Drama']);
        Category::create(['name' => 'Comedia']);
        

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
