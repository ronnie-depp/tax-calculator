<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;

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
            //$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            //$table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });

        // Enable Foreign Key Constraints
        //Schema::enableForeignKeyConstraints();

        // Insert Default Users, Websites & Roles

        // Admin (is Agent & User for all available options by default.)
        /*
        DB::table('users_roles')->insert(
            array(
                'user_id' => '9e3b5923-2d44-43ae-aa6e-1112f54ea152',
                'role_id' => 'c5338e54-1a5e-42b3-b772-72caac35b38d',// Role: Admin
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => '9e3b5923-2d44-43ae-aa6e-1112f54ea152',
                'role_id' => 'c7d69ca6-aebe-417a-a53f-24ed62eeae6b',// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => '9e3b5923-2d44-43ae-aa6e-1112f54ea152',
                'role_id' => 'c990066b-54ca-4576-ace0-050b39e3b832',// Role: User
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => af5427f9-850c-4a4d-8f86-30fc2491e986,
                'role_id' => 'c5338e54-1a5e-42b3-b772-72caac35b38d',// Role: Admin
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => af5427f9-850c-4a4d-8f86-30fc2491e986,
                'role_id' => 'c7d69ca6-aebe-417a-a53f-24ed62eeae6b',// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => af5427f9-850c-4a4d-8f86-30fc2491e986,
                'role_id' => 'c990066b-54ca-4576-ace0-050b39e3b832',// Role: User
                'created_at' => NOW()
            )
        );
        // Agent
        DB::table('users_roles')->insert(
            array(
                'user_id' => '12c63a0d-2338-48f3-a8c5-1b13f71a85fa',
                'role_id' => 'c7d69ca6-aebe-417a-a53f-24ed62eeae6b',// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => '12c63a0d-2338-48f3-a8c5-1b13f71a85fa',
                'role_id' => 'c990066b-54ca-4576-ace0-050b39e3b832',// Role: User
                'created_at' => NOW()
            )
        );
        // User
        DB::table('users_roles')->insert(
            array(
                'user_id' => '08ab3b1f-9c7a-4691-916b-4bfe107a18e8',
                'role_id' => 'c990066b-54ca-4576-ace0-050b39e3b832',// Role: User
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 'f7d92112-9ae5-4e45-9cb7-355d84c919c2',
                'role_id' => 'c990066b-54ca-4576-ace0-050b39e3b832',// Role: User
                'created_at' => NOW()
            )
        );
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable Foreign Key Constraints
        //Schema::disableForeignKeyConstraints();

        /*
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
        */

        // Drop Table
        Schema::dropIfExists('users_roles');
    }
};
