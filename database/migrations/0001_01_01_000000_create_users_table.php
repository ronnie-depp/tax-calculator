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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('is_active');
            $table->softDeletes($column = 'deleted_at')->comment('Suspended Role.');
            $table->timestamps();
        });

        // Insert Default SuperAdmin/Author
        DB::table('users')->insert(
            array(
                'name' => 'Ronnie DeppleGanger',
                'email' => 'mr.salman.ahmad@gmail.com',
                'email_verified_at' => NOW(),
                'pwd' => md5('P@ssword'),
                'is_active' => 1,
                'created_at' => NOW()
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'Tahreem J. Naseem',
                'email' => 'myself@tahreems.com',
                'email_verified_at' => NOW(),
                'pwd' => md5('P@ssword'),
                'is_active' => 1,
                'created_at' => NOW()
            )
        );

        // Insert Few Agents & Users
        DB::table('users')->insert(
            array(
                'name' => 'Cheeku',
                'email' => 'Cheeku@Meeku.com',
                'email_verified_at' => NOW(),
                'pwd' => md5('P@ssword'),
                'is_active' => 1,
                'created_at' => NOW()
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'Bumbbu Kaat',
                'email' => 'BumbbuKaat@TambbuChaat.com',
                'email_verified_at' => NOW(),
                'pwd' => md5('P@ssword'),
                'is_active' => 1,
                'created_at' => NOW()
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'Ali Hussnain',
                'email' => 'huss@nain.com',
                'email_verified_at' => NOW(),
                'pwd' => md5('P@ssword'),
                'is_active' => 1,
                'created_at' => NOW()
            )
        );

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
