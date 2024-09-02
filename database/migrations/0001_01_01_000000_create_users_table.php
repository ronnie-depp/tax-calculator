<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Hashing\Hasher;
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
        // Disable Foreign Key Constraints
        Schema::disableForeignKeyConstraints();

        /*
        if (!Schema::hasTable('users')) {
            // The "users" does not table exist...
        }
        */

        if (Schema::hasTable('users')) {
            // The "users" table exists...
        }

        Schema::withoutForeignKeyConstraints(function () {
            // Constraints disabled within this closure...
            Schema::create('users', function (Blueprint $table) {

                $table->uuid('id')->primary();//->first()
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->default(Hash::make('P@ssword'));
                $table->rememberToken()->nullable();
                $table->tinyInteger('is_active');//->default(1)
                $table->softDeletes($column = 'deleted_at')->comment('Suspended Role.');
                $table->timestamps();
            });
    
            // Insert Default SuperAdmin/Author
            DB::table('users')->insert(
                array(
                    'id' => (string) Uuid::uuid4(),
                    'name' => 'Ronnie DeppleGanger',
                    'email' => 'mr.salman.ahmad@gmail.com',
                    'email_verified_at' => NOW(),
                    'password' => Hash::make('P@ssword'),//md5('P@ssword')
                    'is_active' => 1,
                    'created_at' => NOW()
                )
            );
            DB::table('users')->insert(
                array(
                    'id' => (string) Uuid::uuid4(),
                    'name' => 'Tahreem J. Naseem',
                    'email' => 'myself@tahreems.com',
                    'email_verified_at' => NOW(),
                    'password' => Hash::make('P@ssword'),
                    'is_active' => 1,
                    'created_at' => NOW()
                )
            );
    
            // Insert Few Agents & Users
            DB::table('users')->insert(
                array(
                    'id' => (string) Uuid::uuid4(),
                    'name' => 'Cheeku',
                    'email' => 'Cheeku@Meeku.com',
                    'email_verified_at' => NOW(),
                    'password' => Hash::make('P@ssword'),
                    'is_active' => 1,
                    'created_at' => NOW()
                )
            );
            DB::table('users')->insert(
                array(
                    'id' => (string) Uuid::uuid4(),
                    'name' => 'Bumbbu Kaat',
                    'email' => 'BumbbuKaat@TambbuChaat.com',
                    'email_verified_at' => NOW(),
                    'password' => Hash::make('P@ssword'),
                    'is_active' => 1,
                    'created_at' => NOW()
                )
            );
            DB::table('users')->insert(
                array(
                    'id' => (string) Uuid::uuid4(),
                    'name' => 'Ali Hussnain',
                    'email' => 'huss@nain.com',
                    'email_verified_at' => NOW(),
                    'password' => Hash::make('P@ssword'),
                    'is_active' => 1,
                    'created_at' => NOW()
                )
            );
    
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();//->first();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
    
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();//->first();
                $table->foreignId('user_id')->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity')->index();
            });
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable Foreign Key Constraints
        Schema::disableForeignKeyConstraints();

        Schema::withoutForeignKeyConstraints(function () {
            // Constraints disabled within this closure...
            Schema::dropIfExists('sessions');
            Schema::dropIfExists('password_reset_tokens');
            Schema::dropIfExists('users');
        });
    }
};
