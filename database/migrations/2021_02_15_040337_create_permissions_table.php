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
            ['action' => 'super_administrator'],

            // User Management
            ['action' => 'user.create'],
            ['action' => 'user.read'],
            ['action' => 'user.update'],
            ['action' => 'user.delete'],

            // Role Management
            ['action' => 'role.create'],
            ['action' => 'role.read'],
            ['action' => 'role.update'],
            ['action' => 'role.delete'],

            // UserRole Management
            ['action' => 'role_user.create'],
            ['action' => 'role_user.read'],
            ['action' => 'role_user.delete']

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
