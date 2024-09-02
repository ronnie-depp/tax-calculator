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
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('sort_order')->unique();
            $table->string('role')->comment('User Roles: 1 Admin, 2 Agent, 3 User')->unique();
            $table->tinyInteger('is_active');//->default(1)
            $table->softDeletes($column = 'deleted_at')->comment('Suspended Role.')->nullable();
            $table->timestamps();
        });

        // Insert Default Roles
        DB::table('roles')->insert(
            array(
                'id' => (string) Uuid::uuid4(),
                'sort_order' => 1,
                'role' => 'Admin',
                'is_active' => 1,
                'created_at' => NOW()
            )
        );
        DB::table('roles')->insert(
            array(
                'id' => (string) Uuid::uuid4(),
                'sort_order' => 2,
                'role' => 'Agent',
                'is_active' => 1,
                'created_at' => NOW()
            )
        );
        DB::table('roles')->insert(
            array(
                'id' => (string) Uuid::uuid4(),
                'sort_order' => 3,
                'role' => 'User',
                'is_active' => 1,
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
