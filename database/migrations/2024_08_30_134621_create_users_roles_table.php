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
            $table->foreignId('user_id')->default((string) Uuid::uuid4());
            $table->foreignId('role_id')->default((string) Uuid::uuid4())->comment('User Roles by sort_order: 1 Admin, 2 Agent, 3 User');
            $table->timestamps();
            // Define Foreign Keys
            //$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            //$table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
        });

        // Enable Foreign Key Constraints
        //Schema::enableForeignKeyConstraints();

        // Insert Default Users, Websites & Roles

        // Admin (is Agent & User for all available options by default.)
        
        DB::table('users_roles')->insert(
            array(
                'user_id' => 'a90b50e1-ccd6-4f4f-af24-c89ca554ab8f',
                'role_id' => '919be02f-01a3-4e1e-a408-b8fc59e6eba4',// Role: Admin
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 'a90b50e1-ccd6-4f4f-af24-c89ca554ab8f',
                'role_id' => '9c272857-fea4-4651-8e80-de04c93f195d',// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 'a90b50e1-ccd6-4f4f-af24-c89ca554ab8f',
                'role_id' => '6c4f4239-6b89-48a2-b1df-d992775692d2',// Role: User
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => '010cf77e-694c-4a95-a2a2-77eefa3e7527',
                'role_id' => '919be02f-01a3-4e1e-a408-b8fc59e6eba4',// Role: Admin
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => '010cf77e-694c-4a95-a2a2-77eefa3e7527',
                'role_id' => '9c272857-fea4-4651-8e80-de04c93f195d',// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => '010cf77e-694c-4a95-a2a2-77eefa3e7527',
                'role_id' => '6c4f4239-6b89-48a2-b1df-d992775692d2',// Role: User
                'created_at' => NOW()
            )
        );
        // Agent
        DB::table('users_roles')->insert(
            array(
                'user_id' => 'b41ccada-67d6-496a-8595-5e7805213662',
                'role_id' => '9c272857-fea4-4651-8e80-de04c93f195d',// Role: Agent
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 'b41ccada-67d6-496a-8595-5e7805213662',
                'role_id' => '6c4f4239-6b89-48a2-b1df-d992775692d2',// Role: User
                'created_at' => NOW()
            )
        );
        // User
        DB::table('users_roles')->insert(
            array(
                'user_id' => '201883f8-6b5d-4f8b-99f1-6e44f40c5924',
                'role_id' => '6c4f4239-6b89-48a2-b1df-d992775692d2',// Role: User
                'created_at' => NOW()
            )
        );
        DB::table('users_roles')->insert(
            array(
                'user_id' => 'f5ce07ec-9cf2-4dbd-8703-bfbfd2544508',
                'role_id' => '6c4f4239-6b89-48a2-b1df-d992775692d2',// Role: User
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
