<?php

namespace App\Http\Controllers;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Expense;

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
                     $products = Product::latest()->paginate(10);
                     $expenses = Expense::orderBy('date', 'desc')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);
                           $totalExpenses = Expense::sum('amount');
                    
      return view('dashboard' , compact('bills', 'expenses', 'totalExpenses', 'customers', 'totalBills',
            'totalSales',
            'todaySales',
            'thisMonthSales',
            'totalCustomers',
            'totalDue',
            'products'));
    }


public function getReportData(Request $request)
    {
        $start = $request->query('start', now()->startOfMonth()->format('Y-m-d'));
        $end   = $request->query('end', now()->format('Y-m-d'));

        // তারিখের রেঞ্জে ডাটা
        $salesQuery = Sale::whereDate('created_at', '>=', $start)
                          ->whereDate('created_at', '<=', $end);

        // ১. মাসিক বিক্রয়
        $sales = (clone $salesQuery)
            ->selectRaw('DATE_FORMAT(created_at, "%b %Y") as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderByRaw('MIN(created_at)')
            ->pluck('total', 'month');

        // ২. পেমেন্ট মেথড
        $payment = (clone $salesQuery)
            ->selectRaw('COALESCE(payment_method, "অন্যান্য") as method, COUNT(*) as count')
            ->groupBy('method')
            ->pluck('count', 'method');

        // ৩. টপ ১০ প্রোডাক্ট
        if (class_exists(SaleItem::class)) {
            $topProducts = SaleItem::whereHas('sale', fn($q) => $q->whereDate('sales.created_at', '>=', $start)->whereDate('sales.created_at', '<=', $end))
                ->selectRaw('product_name, SUM(quantity) as qty')
                ->groupBy('product_name')
                ->orderByDesc('qty')
                ->limit(10)
                ->pluck('qty', 'product_name');
        } else {
            $topProducts = collect();
        }

        // ৪. টপ ১০ কাস্টমার
        $topCustomers = (clone $salesQuery)
            ->selectRaw('COALESCE(customer_name, customer_phone, "অজানা") as name, SUM(total_amount) as total')
            ->groupBy('name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $bn = [
            'cash' => 'নগদ', 'bkash' => 'বিকাশ', 'nagad' => 'নগদ',
            'rocket' => 'রকেট', 'card' => 'কার্ড', 'bank' => 'ব্যাংক'
        ];

        return response()->json([
            'sales' => [
                'labels' => $sales->keys()->toArray(),
                'data'   => $sales->values()->map(fn($v) => (float)$v)->toArray()
            ],
            'payment' => [
                'labels' => $payment->keys()->map(fn($k) => $bn[$k] ?? ucfirst($k))->toArray(),
                'data'   => $payment->values()->map(fn($v) => (int)$v)->toArray()
            ],
            'topProducts' => [
                'labels' => $topProducts->keys()->toArray(),
                'data'   => $topProducts->values()->map(fn($v) => (int)$v)->toArray()
            ],
            'topCustomers' => $topCustomers
        ]);
    }



    //  public function store(Request $request)
    // {
    //     $request->validate([
    //         'customer_id' => 'required|exists:customers,id',
    //         'items' => 'required|array',
    //         'items.*.product_id' => 'required|exists:products,id',
    //         'items.*.quantity' => 'required|integer|min:1',
    //         'payment_method' => 'required',
    //         'status' => 'required|in:paid,pending,due',
    //     ]);

    //     $subtotal = 0;
    //     $items = [];

    //     foreach ($request->items as $item) {
    //         $product = Product::find($item['product_id']);
    //         $total = $product->price * $item['quantity'];
    //         $subtotal += $total;

    //         $items[] = [
    //             'product_id' => $product->id,
    //             'quantity' => $item['quantity'],
    //             'unit_price' => $product->price,
    //             'total' => $total,
    //         ];
    //     }

    //     $vat = $subtotal * 0.05; // 5%
    //     $discount = $request->discount ?? 0;
    //     $grand_total = $subtotal + $vat - $discount;

    //     $bill = Bill::create([
    //         'invoice_no' => 'INV-' . strtoupper(substr(uniqid(), -6)),
    //         'customer_id' => $request->customer_id,
    //         'date' => now(),
    //         'subtotal' => $subtotal,
    //         'vat' => $vat,
    //         'discount' => $discount,
    //         'grand_total' => $grand_total,
    //         'payment_method' => $request->payment_method,
    //         'status' => $request->status,
    //         'note' => $request->note,
    //     ]);

    //     foreach ($items as $item) {
    //         BillItem::create(array_merge($item, ['bill_id' => $bill->id]));
    //     }

    //     return response()->json(['success' => true, 'bill' => $bill]);
    // }
    

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')
                         ->with('success', 'খরচ মুছে ফেলা হয়েছে!');
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

