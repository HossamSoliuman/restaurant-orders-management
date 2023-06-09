<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    use ApiResponse;
    
    public function totalOrders($startDate, $endDate = null)
    {
        if (!$endDate) {
            $endDate = now();
        }
        $startDate = Carbon::parse($startDate)->format('Y-m-d H:i:s');
        $endDate=Carbon::parse($endDate)->format('Y-m-d H:i:s');
        
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();
        
        return $this->successResponse([
            'total_orders' => $totalOrders,
        ]);
    }
    
    public function ordersChartData()
    {
        $status = [
            'pending',
            'received',
            'ready to be prepared',
            'preparing',
            'ready to be delivered',
            'delivering',
            'completed',
            'canceled',
        ];

        $data = [];

        foreach ($status as $value) {
            $count = Order::where('status', $value)->count();
            $data[] = [
                'status' => $value,
                'count' => $count,
            ];
        }

        return $this->successResponse($data);
    }

    public function totalUsers()
    {
        $totalUsers = User::count();
        
        return $this->successResponse([
            'total_users' => $totalUsers,
        ]);
    }
}