<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use App\Models\Customer;

use PDF;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        $bills=Bill::all();
        $bills = Bill::with('customer')
                ->latest('date')        // অথবা latest('id')
                ->paginate(10);
             $customers = Customer::withCount('bills')
        ->withSum('bills', 'grand_total')   // এখানে "as subtotal" লাগবে না
        ->latest()
        ->get();

        $totalBills     = Bill::count();
        $totalSales     = Bill::sum('grand_total');
        $todaySales     = Bill::whereDate('date', today())->sum('grand_total');
        $thisMonthSales = Bill::whereMonth('date', now()->month)
                              ->whereYear('date', now()->year)
                              ->sum('grand_total');
                              $totalCustomers = Customer::count();
                    $totalDue = Bill::whereIn('status', ['due', 'partial'])->sum('grand_total');
                    
      return view('dashboard' , compact('bills', 'customers', 'totalBills',
            'totalSales',
            'todaySales',
            'thisMonthSales',
            'totalCustomers',
            'totalDue'));
    }


     public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required',
            'status' => 'required|in:paid,pending,due',
        ]);

        $subtotal = 0;
        $items = [];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $total = $product->price * $item['quantity'];
            $subtotal += $total;

            $items[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'total' => $total,
            ];
        }

        $vat = $subtotal * 0.05; // 5%
        $discount = $request->discount ?? 0;
        $grand_total = $subtotal + $vat - $discount;

        $bill = Bill::create([
            'invoice_no' => 'INV-' . strtoupper(substr(uniqid(), -6)),
            'customer_id' => $request->customer_id,
            'date' => now(),
            'subtotal' => $subtotal,
            'vat' => $vat,
            'discount' => $discount,
            'grand_total' => $grand_total,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
            'note' => $request->note,
        ]);

        foreach ($items as $item) {
            BillItem::create(array_merge($item, ['bill_id' => $bill->id]));
        }

        return response()->json(['success' => true, 'bill' => $bill]);
    }

    public function printView(Bill $bill)
    {
        $bill->load('customer', 'items.product');
        return view('frontend.bills.print', compact('bill'));
    }

    public function pdf(Bill $bill)
    {
        $bill->load('customer', 'items.product');
        $pdf = PDF::loadView('frontend.bills.print', compact('bill'));
        return $pdf->download('bill-' . $bill->invoice_no . '.pdf');
    }
}

