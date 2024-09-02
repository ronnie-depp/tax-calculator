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
        Schema::create('users_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('role_id')->default(3)->comment('default value 3 for Role: User is used.');
            $table->timestamps();
            // Define Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });

        // Enable Foreign Key Constraints
        Schema::enableForeignKeyConstraints();

        // Insert Default Users, Websites & Roles

        // Admin (is Agent & User for all available options by default.)
        DB::table('users_roles')->insert(
            array(
                'user_id' => 1,
                'role_id' => 1,// Role: Admin
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 1,
                'role_id' => 2,// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 1,
                'role_id' => 3,// Role: User
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 2,
                'role_id' => 1,// Role: Admin
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 2,
                'role_id' => 2,// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 2,
                'role_id' => 3,// Role: User
                'created_at' => NOW()
            )
        );
        // Agent
        DB::table('users_roles')->insert(
            array(
                'user_id' => 3,
                'role_id' => 2,// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 3,
                'role_id' => 3,// Role: User
                'created_at' => NOW()
            )
        );
        // User
        DB::table('users_roles')->insert(
            array(
                'user_id' => 4,
                'role_id' => 3,// Role: User
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 5,
                'role_id' => 3,// Role: User
                'created_at' => NOW()
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable Foreign Key Constraints
        Schema::disableForeignKeyConstraints();

        // Drop Foreign Keys
        Schema::table('users_roles', function (Blueprint $table) {

            // Check If Foreign Keys Exist
            $keyExists = DB::select(
                DB::raw(
                    'SHOW KEYS
                    FROM users_roles
                    WHERE Key_name=\'users_roles_user_id_foreign\''
                )
            );
            // Drop FK
            if($keyExists){
                $table->dropForeign('users_roles_user_id_foreign');
            }

            // Check If Foreign Keys Exist
            $keyExists = DB::select(
                DB::raw(
                    'SHOW KEYS
                    FROM users_websites_roles
                    WHERE Key_name=\'users_roles_role_id_foreign\''
                )
            );
            // Drop FK
            if($keyExists){
                $table->dropForeign('users_roles_role_id_foreign');
            }

        });

        // Drop Table
        Schema::dropIfExists('users_roles');
    }
};
