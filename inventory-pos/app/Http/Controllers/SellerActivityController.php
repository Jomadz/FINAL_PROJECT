<?php

namespace App\Http\Controllers;

use App\Models\SellerActivity;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class SellerActivityController extends Controller
{
  


    //  Show only login/logout activities
    public function loginLogoutActivities(Request $request)
    {

        $activityType = $request->input('activity_type');
        $date = $request->input('date');


        $activities = SellerActivity::with('user')
            ->whereIn('activity_type', ['login', 'logout'])
            ->when($activityType, function ($query, $activityType) {
                return $query->where('activity_type', 'like', '%' . $activityType . '%');
                })
                ->when($date, function ($query, $date) {
                    return $query->whereDate('created_at', $date);
                })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.login-logout-activities', compact('activities'));
    }

    //  Show only product-related activities
    public function productActivities(Request $request)
    {
        $activityType = $request->input('activity_type');
        $date = $request->input('date');

        $activities = SellerActivity::with('user', 'product')
            ->whereIn('activity_type', ['product_added', 'product_edited', 'product_deleted'])

            ->when($activityType, function ($query, $activityType) {
                return $query->where('activity_type', 'like', '%' . $activityType . '%');
            })
            ->when($date, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })

            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.product-activities', compact('activities'));
    }

    public function logActivity($activityType, $productId = null)
    {
        SellerActivity::create([
            'user_id' => Auth::id(),
            'activity_type' => $activityType,
            'product_id' => $productId,
            'created_at' => now(),
        ]);
    }

    public function logLogin()
    {
        $this->logActivity('login');
    }

    public function logLogout()
    {
        $this->logActivity('logout');
    }

    public function logProductAdded($productId)
    {
        $this->logActivity('product_added', $productId);
    }

    public function logProductEdited($productId)
    {
        $this->logActivity('product_edited', $productId);
    }

    public function logProductDeleted($productId)
    {
        $this->logActivity('product_deleted', $productId);
    }
}
