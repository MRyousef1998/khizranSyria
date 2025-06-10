<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [
  
    'الصندوق',
    'الارباح',
    'الجرودات',
    'المستخدمين',
    'قائمة المستخدمين',
    'عرض صلاحية',
    'تعديل صلاحية',
    'حذف صلاحية',
    'اضافة صلاحية',

];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}