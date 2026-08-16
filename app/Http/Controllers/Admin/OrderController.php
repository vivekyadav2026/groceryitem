<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\UpsService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhere('shipping_name', 'like', '%' . $request->search . '%')
                  ->orWhere('shipping_email', 'like', '%' . $request->search . '%');
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status'         => 'required|string|in:pending,processing,shipped,completed,cancelled,failed',
            'payment_status' => 'required|string|in:pending,completed,failed',
        ]);

        $order->update([
            'status'         => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function createUpsShipment(Order $order, Request $request, UpsService $upsService)
    {
        $serviceCode = $request->input('ups_service_code', '03'); // Default: UPS Ground

        try {
            $result = $upsService->createShipment($order, $serviceCode);
            return redirect()->back()->with('success', 'UPS shipment created! Tracking #: ' . $result['tracking_number']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'UPS Error: ' . $e->getMessage());
        }
    }
}
