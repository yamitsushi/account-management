<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->primary(['role_id', 'permission_id']);
            
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        // Default Administrator
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 1
        ]);

        // Role Permission Management
        DB::table('permissions')->insert([
            ['action' => 'PERMISSION_ROLE.PROVIDE']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
        DB::table('permissions')->whereIn('action', [
            'PERMISSION_ROLE.CREATE',
            'PERMISSION_ROLE.READ',
            'PERMISSION_ROLE.DELETE'
        ])->delete();
    }
}
