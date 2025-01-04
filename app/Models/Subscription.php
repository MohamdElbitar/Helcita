<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * Define a relationship with the Clinic model.
     */
    public function clinicData()
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Define a relationship with the SubscriptionType model.
     */
    public function subscriptionTypeData()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id');
    }
}
