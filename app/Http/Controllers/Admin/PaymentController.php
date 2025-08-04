<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;
use App\Models\PaymentCategory;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
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

    $payments = $query->paginate(20)->withQueryString();
    $categories = \App\Models\PaymentCategory::orderBy('name')->get();

    return view('admin.payments.index', compact('payments', 'categories'));
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
            'category' => 'required|string|max:100',
            'month' => 'nullable|string|max:20',
            'paid_at' => 'required|date',
            'amount' => 'required|numeric|min:1000',
            'method' => 'nullable|string|max:50',
            'note' => 'nullable|string',
        ]);

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

    $payment->update($validated);

    return redirect()->route('admin.payments.index')
        ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->with('success', 'Pembayaran dihapus.');
    }
}
