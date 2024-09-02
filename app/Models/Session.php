<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
/* use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User; */

class Session extends Model
{
    use HasUuids, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'sort_order',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    // Relationships Mapping Functions
    
    /**
     * Get all of the Users for this Role.
     */
    /* public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_roles', 'role_id', 'user_id');
    } */

    // ************ To Create Completely Unique & "Unordered" UUIDs
    //use Ramsey\Uuid\Uuid;
 
    /**
     * Generate a new UUID for the model.
     */
    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }
    
    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['id'];//, 'discount_code'
    }

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    
    /**
     * Model's to be assigned newUuid.
     *
     * @var string
     */
    public $id = '';
    
    /**
     * Indicates model's last <sort_order> is incremental.
     *
     * @var int
     */
    public $lastSortOrder = 0;
    
    /**
     * Indicates model's current <sort_order> is incremental.
     *
     * @var int
     */
    public $currentSortOrder = 0;
    
    public function incrementSortOrder(){
        $this->currentSortOrder = DB::table('sessions')->select('*')->orderByDesc('sort_order')->first();
        if(isset($this->currentSortOrder)){
            if($this->currentSortOrder->sort_order() === NULL){
                $this->currentSortOrder = 1;
            }
            elseif($this->currentSortOrder->sort_order() !== NULL){
                $this->currentSortOrder = (int) $this->currentSortOrder->sort_order();
                $this->lastSortOrder = $this->currentSortOrder + 1;
            }
            else{
                dd('Database Logical Error: Recordset not found error!');
            }
        }
    }

    public function setId(){
        $this->id = $this->newUniqueId();
    }

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    /*protected $attributes = [
        //generates error maybe due to non-static calculated default values using functions are not allowed//'password' => Hash::make('P@ssword'),
        'id' => $this->id,
        'sort_order' => $this->lastSortOrder,//1,//'options' => '[]',
        //generates error maybe due to non-static calculated default values using functions are not allowed//'created_at' => ''.NOW().'', //'delayed' => false,
    ];
    */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sessions';
    
}
