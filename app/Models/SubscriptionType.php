<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * Define a relationship with the Subscription model.
     */
    public function subscriptionsData()
    {
        return $this->hasMany(Subscription::class);
    }
}
