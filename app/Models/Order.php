<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'shipping_address',
        'billing_address',
    ];

    /**
     * Get the user that owns the order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}



?>