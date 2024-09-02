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
        // Disable Foreign Key Constraints
        Schema::disableForeignKeyConstraints();

        
        if (!Schema::hasTable('users')) {
            // The "users" does not table exist...
            
            Schema::withoutForeignKeyConstraints(function () {
                // Constraints disabled within this closure...
                Schema::create('users', function (Blueprint $table) {

                    $table->increments('sort_order');//->unique();/*->default((int) 1);//<--returns String value insterad of Integer*///$table->bigInteger('sort_order')->unique();
                    $table->dropPrimary('users_sort_order_primary');
                    $table->uuid('id')->default((string) Uuid::uuid4());//->primary();//->first()
                    $table->string('name');
                    $table->string('email')->unique();
                    $table->timestamp('email_verified_at')->nullable();
                    $table->string('password')->default(Hash::make('P@ssword'));
                    $table->rememberToken()->nullable();
                    $table->tinyInteger('is_active');//->default(1)
                    $table->softDeletes($column = 'deleted_at')->comment('Suspended Role.')->nullable();
                    $table->timestamps();

                    // set uuid id column as primary key
                    $table->primary('id');
                });
        
                // Insert Default SuperAdmin/Author
                DB::table('users')->insert(
                    array(
                        'id' => (string) Uuid::uuid4(),
                        'sort_order' => 1,
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
                        'sort_order' => 2,
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
                        'sort_order' => 3,
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
                        'sort_order' => 4,
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
                        'sort_order' => 5,
                        'name' => 'Ali Hussnain',
                        'email' => 'huss@nain.com',
                        'email_verified_at' => NOW(),
                        'password' => Hash::make('P@ssword'),
                        'is_active' => 1,
                        'created_at' => NOW()
                    )
                );
            });
        }

        if (!Schema::hasTable('password_reset_tokens')) {
            // The table does not exist...
            
            Schema::withoutForeignKeyConstraints(function () {
                // Constraints disabled within this closure...
                
                Schema::create('password_reset_tokens', function (Blueprint $table) {
                    $table->string('email')->primary();//->first();
                    $table->string('token');
                    $table->timestamp('created_at')->nullable();
                });
            });
        }

        if (!Schema::hasTable('sessions')) {
            // The table does not exist...
            
            Schema::withoutForeignKeyConstraints(function () {
                // Constraints disabled within this closure...
                
        
                Schema::create('sessions', function (Blueprint $table) {
                    /*
                    $lastSortOrder = DB::table('sessions')->select('*')->orderByDesc('sort_order')->first();
                    if(isset($lastSortOrder)){
                        if($lastSortOrder->sort_order() === NULL){
                            $lastSortOrder = 1;
                        }
                        elseif($lastSortOrder->sort_order() !== NULL){
                            $lastSortOrder = (int) $lastSortOrder->sort_order();
                        }
                        else{
                            dd('Database Logical Error: Recordset not found error!');
                        }
                    }
                    $lastSortOrder = DB::table('sessions')->select('sort_order')->where('sort_order', '<>', NULL)->orderByDesc('sort_order')->first();
                    //$lastSortOrder = DB::table('sessions')->select('sort_order')->where('sort_order', '=', NULL)->orderByDesc('sort_order')->first();
                    */
                    //$request->session()->increment('sort_order')
                    /*$table->bigInteger*/$table->increments('sort_order');//->unique();//->default((int) 1);////->toInteger();
                    $table->dropPrimary('sort_order');
                    $table->uuid('id')->default((string) Uuid::uuid4());//->primary()//->first();
                    $table->foreignId('user_id')->nullable()->index();
                    $table->string('ip_address', 45)->nullable();
                    $table->text('user_agent')->nullable();
                    $table->longText('payload');
                    $table->integer('last_activity')->index();

                    // set uuid id column as primary key
                    $table->primary('id');

                    // Define Foreign Keys
                    ////$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                    
                });
        
                // Insert Default Session
                DB::table('users')->insert(
                    array(
                        'id' => (string) Uuid::uuid4(),
                        'sort_order' => 1,
                        //'user_id' => '8169672b-e182-42f5-bf55-31af5c776c4e',
                        'payload' => 'mr.salman.ahmad@gmail.com',
                        'last_activity' => time(),
                    )
                );

            });

        }
       

        /* if (Schema::hasTable('users')) {
            // The "users" table exists...
        } */
        
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
