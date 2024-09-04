<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'addresses';

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'street_address',
        'city',
        'state',
        'pincode',
        'country'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'user_id' => 'integer',
    ];

    // Define relationships if needed, for example with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}