<?php

namespace App\Http\Controllers;

use App\Models\SellerActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerActivityController extends Controller
{
    public function index(Request $request)
    {
        // Capture the search parameters
        $activityType = $request->input('activity_type');
        $date = $request->input('date');

        // Fetch all seller activities with related user and product
       
        // Query the seller activities and apply filters if any search parameters are provided
        $activities = SellerActivity::with('user', 'product') // Eager load relationships
            ->when($activityType, function ($query, $activityType) {
                return $query->where('activity_type', 'like', '%' . $activityType . '%');
            })
            ->when($date, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->orderBy('created_at', 'desc') // Order by date descending
            ->paginate(15);

        // Return the view with activities
        return view('admin.seller-activities', compact('activities'));
    }

    /**
     * Log a seller activity.
     *
     * @param string $activityType
     * @param int|null $productId
     * @return void
     */
    public function logActivity($activityType, $productId = null)
    {
        // Create a new activity log
        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => $activityType,
            'product_id' => $productId,
            'created_at' => now(),
        ]);
    }

    /**
     * Log a seller login activity.
     *
     * @return void
     */
    public function logLogin()
    {
        $this->logActivity('login');
    }

    /**
     * Log a seller logout activity.
     *
     * @return void
     */
    public function logLogout()
    {
        $this->logActivity('logout');
    }

    /**
     * Log a product addition activity.
     *
     * @param int $productId
     * @return void
     */
    public function logProductAdded($productId)
    {
        $this->logActivity('product_added', $productId);
    }

    /**
     * Log a product edit activity.
     *
     * @param int $productId
     * @return void
     */
    public function logProductEdited($productId)
    {
        $this->logActivity('product_edited', $productId);
    }

    /**
     * Log a product sold activity.
     *
     * @param int $productId
     * @return void
     */
    public function logProductSold($productId)
    {
        $this->logActivity('product_sold', $productId);
    }
}