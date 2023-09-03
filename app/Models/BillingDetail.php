<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'state',
        'zip_code',
        // Add other fields as needed
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cartItem()
    {
        return $this->belongsTo(Shoppingcart::class);
    }
}
