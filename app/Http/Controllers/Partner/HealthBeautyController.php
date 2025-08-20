<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\HealthBeautyTransaction;
use App\Models\HealthBeautyPackage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HealthBeautyController extends Controller
{
    public function index(Request $request)
    {
        $query = HealthBeautyTransaction::with(['user', 'package'])
            ->orderBy('created_at', 'desc');

        // Filter by year
        if ($request->has('year') && $request->year != '') {
            $query->whereYear('purchase_date', $request->year);
        }

        // Filter by date range
        if ($request->has('start') && $request->start != '') {
            $query->whereDate('purchase_date', '>=', $request->start);
        }

        if ($request->has('end') && $request->end != '') {
            $query->whereDate('purchase_date', '<=', $request->end);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            switch ($request->status) {
                case 'active':
                    $query->active();
                    break;
                case 'expired':
                    $query->expired();
                    break;
                case 'pending':
                    $query->pending();
                    break;
            }
        }

        $transactions = $query->paginate(10);

        return view('ekstranet.health-beauty.index', compact('transactions'));
    }

    public function detail($id)
    {
        $transaction = HealthBeautyTransaction::with(['user', 'package'])
            ->findOrFail($id);

        return view('ekstranet.health-beauty.detail', compact('transaction'));
    }

    public function cetakTiket($id)
    {
        $transaction = HealthBeautyTransaction::with(['user', 'package'])
            ->findOrFail($id);

        // Logic untuk mencetak tiket
        return view('ekstranet.health-beauty.e-tiket', compact('transaction'));
    }

    public function create()
    {
        $packages = HealthBeautyPackage::where('is_active', true)->get();
        return view('ekstranet.health-beauty.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:health_beauty_packages,id',
            'purchase_date' => 'required|date',
            'payment_status' => 'required|in:pending,paid,failed',
            'notes' => 'nullable|string'
        ]);

        $package = HealthBeautyPackage::findOrFail($request->package_id);
        $purchaseDate = Carbon::parse($request->purchase_date);
        $expiryDate = $purchaseDate->copy()->addDays($package->validity_days);

        $transaction = HealthBeautyTransaction::create([
            'transaction_code' => 'HB-' . strtoupper(uniqid()),
            'user_id' => $request->user_id,
            'package_id' => $request->package_id,
            'total_price' => $package->price,
            'payment_status' => $request->payment_status,
            'purchase_date' => $purchaseDate,
            'expiry_date' => $expiryDate,
            'notes' => $request->notes
        ]);

        return redirect()->route('partner.health-beauty.index')
            ->with('success', 'Transaksi berhasil dibuat.');
    }

    public function edit($id)
    {
        $transaction = HealthBeautyTransaction::findOrFail($id);
        $packages = HealthBeautyPackage::where('is_active', true)->get();
        
         return view('ekstranet.health-beauty.edit', compact('transaction', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'package_id' => 'required|exists:health_beauty_packages,id',
            'purchase_date' => 'required|date',
            'payment_status' => 'required|in:pending,paid,failed',
            'notes' => 'nullable|string'
        ]);

        $transaction = HealthBeautyTransaction::findOrFail($id);
        $package = HealthBeautyPackage::findOrFail($request->package_id);
        $purchaseDate = Carbon::parse($request->purchase_date);
        $expiryDate = $purchaseDate->copy()->addDays($package->validity_days);

        $transaction->update([
            'package_id' => $request->package_id,
            'total_price' => $package->price,
            'payment_status' => $request->payment_status,
            'purchase_date' => $purchaseDate,
            'expiry_date' => $expiryDate,
            'notes' => $request->notes
        ]);

        return redirect()->route('partner.health-beauty.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaction = HealthBeautyTransaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('partner.health-beauty.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}