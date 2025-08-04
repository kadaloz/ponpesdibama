<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\PaymentCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Exports\PaymentsExport;
use Maatwebsite\Excel\Facades\Excel;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
       $query = Payment::with(['student', 'category'])->latest();

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('student_name')) {
        $query->whereHas('student', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->student_name . '%');
        });
    }
        if ($request->filled('month')) {
        $query->where('month', $request->month);
    }

    $payments = $query->paginate(20)->withQueryString();
    $categories = \App\Models\PaymentCategory::orderBy('name')->get();
    $total = (clone $query)->sum('amount');


    return view('admin.payments.index', compact('payments', 'categories', 'total'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        $categories = PaymentCategory::orderBy('name')->get();

        return view('admin.payments.create', compact('students', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'category_id' => 'required|exists:payment_categories,id',
        'month' => 'nullable|string|max:20',
        'paid_at' => 'required|date',
        'amount' => 'required|numeric|min:1000',
        'method' => 'nullable|string|max:50',
        'note' => 'nullable|string',
    ]);

    // ✅ Cek duplikat berdasarkan student + category + month
    $exists = Payment::where('student_id', $validated['student_id'])
        ->where('category_id', $validated['category_id'])
        ->when($validated['month'], function ($query, $month) {
            $query->where('month', $month);
        })
        ->exists();

    if ($exists) {
        throw ValidationException::withMessages([
            'month' => 'Pembayaran untuk kategori dan bulan ini sudah pernah dilakukan oleh santri yang sama.',
        ]);
    }

    Payment::create($validated);

    return redirect()->route('admin.payments.index')
        ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $students = Student::orderBy('name')->get();
        $categories = PaymentCategory::orderBy('name')->get();

        return view('admin.payments.edit', compact('payment', 'students', 'categories'));
    }

    public function update(Request $request, Payment $payment)
    {
       $validated = $request->validate([
        'student_id' => 'required|exists:students,id',
        'category_id' => 'required|exists:payment_categories,id',
        'month' => 'nullable|string|max:20',
        'paid_at' => 'required|date',
        'amount' => 'required|numeric|min:1000',
        'method' => 'nullable|string|max:50',
        'note' => 'nullable|string',
    ]);

    // ✅ Cek duplikat — abaikan record ini sendiri
    $exists = Payment::where('id', '!=', $payment->id) // exclude record yg sedang diupdate
        ->where('student_id', $validated['student_id'])
        ->where('category_id', $validated['category_id'])
        ->when($validated['month'], function ($query, $month) {
            $query->where('month', $month);
        })
        ->exists();

    if ($exists) {
        throw ValidationException::withMessages([
            'month' => 'Pembayaran untuk kategori dan bulan ini sudah pernah dilakukan oleh santri yang sama.',
        ]);
    }

    $payment->update($validated);

    return redirect()->route('admin.payments.index')
        ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->with('success', 'Pembayaran dihapus.');
    }

    public function printReceipt(Payment $payment)
{
    // Buat QR code dalam bentuk PNG (base64)
    $qr = base64_encode(
        QrCode::format('png')
            ->size(200)
            ->generate(url('/verifikasi/pembayaran/' . $payment->id))
    );

    // Kirim $qr ke view
    return Pdf::loadView('admin.payments.receipt', compact('payment', 'qr'))
              ->stream('struk_pembayaran_' . $payment->id . '.pdf');
}

public function export(Request $request)
{
    $filters = [
        'category' => $request->category_id,
        'student' => $request->student_id,
        'month' => $request->month,
        'search' => $request->search,
    ];

    return Excel::download(new PaymentsExport($filters), 'laporan_pembayaran_' . now()->format('Ymd_His') . '.xlsx');
}


}
