<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Migrations\Migration;

class CreateFcuapiManagePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permFcuApiManage = Permission::create([
            'name'         => 'fcuapi.manage',
            'display_name' => 'FCU API管理權限',
            'description'  => '管理FCU API、調整其產生的測試資料',
            'protection'   => true,
        ]);
        /* @var Role $admin */
        $admin = Role::where('name', 'Admin')->first();
        $admin->attachPermission($permFcuApiManage);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::where('name', 'fcuapi.manage')->delete();
    }
}
