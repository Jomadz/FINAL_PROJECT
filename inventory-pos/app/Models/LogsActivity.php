<?php 

namespace App\Models;

use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::updated(function ($model) {
            // Log only product update activity
            $model->logActivity('edited');
        });

        static::deleted(function ($model) {
            // Log only product deletion activity
            $model->logActivity('deleted');
        });
    }

    protected function logActivity($action)
    {
        // Log only login, logout, and product activities
        if (in_array($action, ['login', 'logout', 'edited', 'deleted'])) {
            SellerActivity::create([
                'user_id' => Auth::id(),
                'activity_type' => $action,
                'product_id' => $this->id, 
                'description' => 'Seller activity logged for ' . $action,
            ]);
        }
    }
}
