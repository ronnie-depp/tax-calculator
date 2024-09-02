<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->comment('User Roles: 1 Admin, 2 Agent, 3 User')->unique();
            $table->softDeletes($column = 'deleted_at')->comment('Suspended Role.');
            $table->timestamps();
        });

        // Insert Default Roles
        DB::table('roles')->insert(
            array(
                'role' => 'Admin',
                'created_at' => NOW()
            )
        );
        DB::table('roles')->insert(
            array(
                'role' => 'Agent',
                'created_at' => NOW()
            )
        );
        DB::table('roles')->insert(
            array(
                'role' => 'User',
                'created_at' => NOW()
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
