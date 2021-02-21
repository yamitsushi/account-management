<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('action', 100)->unique();
        });

        // Default Administrator
        DB::table('permissions')->insert([
            ['action' => 'SUPER_ADMINISTRATOR'],

            // User Management
            ['action' => 'USER.CREATE'],
            ['action' => 'USER.READ'],
            ['action' => 'USER.UPDATE'],
            ['action' => 'USER.DELETE'],

            // Role Management
            ['action' => 'ROLE.CREATE'],
            ['action' => 'ROLE.READ'],
            ['action' => 'ROLE.DELETE'],

            // Permission Access
            ['action' => 'PERMISSION.READ'],

            // UserRole Management
            ['action' => 'ROLE_USER.PROVIDE']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
