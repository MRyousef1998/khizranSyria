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
$role = Role::create(['name' => 'Admin1']);
$permissions = Permission::pluck('id','id')->all();
$role->syncPermissions($permissions);


$user = User::create([
'name' => 'yousef nahhas',
'email' => 'yousef1@admin.com',
'password' => bcrypt('123456'),
'role_id'=>$role->id,

]);

}
}