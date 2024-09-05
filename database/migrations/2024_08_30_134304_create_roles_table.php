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
            $table->uuid('id')->default((string) Uuid::uuid4());
            $table->dropPrimary('PRIMARY');
            $table->bigIncrements('sort_order');//->default(1)
            $table->dropPrimary('PRIMARY');//roles_SortOrder_unique
            $table->string('role')->comment('User Roles by sort_order: 1 Admin, 2 Agent, 3 User')->unique();
            $table->tinyInteger('is_active')->default(1);//
            $table->softDeletes($column = 'deleted_at')->comment('Suspended Role.')->nullable();
            $table->timestamps();

            // set uuid id column as primary key
            $table->primary('id');
            $table->unique('sort_order');
            //$table->unique('role');
        });

        // Insert Default Roles
        DB::table('roles')->insert(
            array(
                'id' => '919be02f-01a3-4e1e-a408-b8fc59e6eba4',//(string) Uuid::uuid4(),
                'sort_order' => 1,
                'role' => 'Admin',
                'is_active' => 1,
                'created_at' => NOW()
            )
        );
        DB::table('roles')->insert(
            array(
                'id' => '9c272857-fea4-4651-8e80-de04c93f195d',//(string) Uuid::uuid4(),
                'sort_order' => 2,
                'role' => 'Agent',
                'is_active' => 1,
                'created_at' => NOW()
            )
        );
        DB::table('roles')->insert(
            array(
                'id' => '6c4f4239-6b89-48a2-b1df-d992775692d2',//(string) Uuid::uuid4(),
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
