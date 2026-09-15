<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Acceso no autorizado. Fúchale');
        }

        $totalRevenue = Order::sum('total_amount');
        $totalOrders = Order::count();
        $itemsSold = OrderItem::sum('quantity');

        $orders = Order::with(['user', 'items.product'])->latest()->get();

        return view('admin.index', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'itemsSold' => $itemsSold,
            'orders' => $orders,
        ]);
    }

    public function exportCsv(): StreamedResponse
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403);
        }

        $orders = Order::with(['user', 'items.product'])->latest()->get();

        return response()->streamDownload(function () use ($orders) {
            $handle = fopen('php://output', 'w');

            fputs($handle, "\xEF\xBB\xBF");

            fputcsv($handle, ['# Pedido', 'Cliente', 'Email', 'Total', 'Estado', 'Fecha', 'Productos']);

            foreach ($orders as $order) {
                $productList = $order->items->map(function ($item) {
                    return "{$item->product->name} (x{$item->quantity})";
                })->implode('; ');

                fputcsv($handle, [
                    $order->id,
                    $order->user->name,
                    $order->user->email,
                    $order->total_amount,
                    $order->status,
                    $order->created_at->format('d/m/Y H:i'),
                    $productList,
                ]);
            }

            fclose($handle);
        }, 'reporte_ventas_' . date('Y-m-d') . '.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function exportPdf()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403);
        }

        $data = [
            'totalRevenue' => Order::sum('total_amount'),
            'totalOrders' => Order::count(),
            'itemsSold' => OrderItem::sum('quantity'),
            'orders' => Order::with(['user', 'items.product'])->latest()->get(),
            'date' => now()->format('d/m/Y H:i'),
        ];

        $pdf = Pdf::loadView('admin.pdf', $data);

        return $pdf->download('reporte_ventas_' . date('Y-m-d') . '.pdf');
    }
}