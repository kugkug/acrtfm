<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use App\Models\WorkOrderStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class WorkOrderStatementController extends Controller
{
    private array $data = [];

    public function __construct()
    {
        $this->data = [
            'theme' => 'light',
            'root_url' => URL::current(),
        ];
    }

    public function show(int $id)
    {
        $workOrder = globalHelper()->getWorkOrder($id);

        if (empty($workOrder)) {
            return redirect()->route('work-orders')->with('error', 'Work Order not found or access denied');
        }

        $statement = WorkOrderStatement::where('work_order_id', $id)->first();

        $this->data['title'] = 'Statement of Account';
        $this->data['header'] = 'Statement of Account';
        $this->data['description'] = empty($statement)
            ? 'Create a statement of account for this completed work order.'
            : 'Review the statement of account details.';
        $this->data['work_order'] = $workOrder;
        $this->data['statement'] = $statement;

        return view('pages.client.tech_dispatch.work_orders.statement', $this->data);
    }

    public function store(Request $request, int $id)
    {
        $workOrder = globalHelper()->getWorkOrder($id);

        if (empty($workOrder)) {
            return redirect()->route('work-orders')->with('error', 'Work Order not found or access denied');
        }

        if (WorkOrderStatement::where('work_order_id', $id)->exists()) {
            return redirect()->route('work-orders.statement.show', $id)
                ->with('error', 'A statement has already been generated for this work order.');
        }

        $validated = $request->validate([
            'statement_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:statement_date',
            'line_items' => 'required|array|min:1',
            'line_items.*.description' => 'required|string|max:255',
            'line_items.*.quantity' => 'nullable|numeric|min:0',
            'line_items.*.unit_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'additional_notes' => 'nullable|string|max:2000',
        ]);

        $subtotal = 0.0;
        $lineItems = [];

        foreach ($validated['line_items'] as $item) {
            $description = trim($item['description'] ?? '');
            $quantity = isset($item['quantity']) && $item['quantity'] !== ''
                ? (float) $item['quantity']
                : 1.0;
            $quantity = max($quantity, 0);
            $unitPrice = isset($item['unit_price']) && $item['unit_price'] !== ''
                ? (float) $item['unit_price']
                : 0.0;
            $unitPrice = max($unitPrice, 0);

            $lineTotal = round($quantity * $unitPrice, 2);
            $subtotal += $lineTotal;

            $lineItems[] = [
                'description' => $description,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'line_total' => $lineTotal,
            ];
        }

        if (empty($lineItems)) {
            return redirect()->route('work-orders.statement.show', $id)
                ->withInput()
                ->with('error', 'Please provide at least one valid line item.');
        }

        $taxRate = isset($validated['tax_rate']) ? (float) $validated['tax_rate'] : 0.0;
        $taxAmount = round($subtotal * ($taxRate / 100), 2);

        $discountAmount = isset($validated['discount_amount']) ? (float) $validated['discount_amount'] : 0.0;
        $discountAmount = max(min($discountAmount, $subtotal + $taxAmount), 0);

        $totalAmount = round($subtotal + $taxAmount - $discountAmount, 2);

        $amountPaid = isset($validated['amount_paid']) ? (float) $validated['amount_paid'] : 0.0;
        $amountPaid = max(min($amountPaid, $totalAmount), 0);

        $balanceDue = round($totalAmount - $amountPaid, 2);

        $statement = WorkOrderStatement::create([
            'work_order_id' => $id,
            'customer_id' => $workOrder['customer']['id'] ?? null,
            'statement_number' => $this->generateStatementNumber(),
            'issued_at' => $validated['statement_date'],
            'due_at' => $validated['due_date'] ?? null,
            'line_items' => $lineItems,
            'subtotal_amount' => $subtotal,
            'tax_rate' => $taxRate,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'amount_paid' => $amountPaid,
            'balance_due' => $balanceDue,
            'notes' => $validated['additional_notes'] ?? null,
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('work-orders.statement.show', $id)
            ->with('success', 'Statement of Account created successfully.');
    }

    public function download(int $id)
    {
        $workOrder = globalHelper()->getWorkOrder($id);

        if (empty($workOrder)) {
            return redirect()->route('work-orders')->with('error', 'Work Order not found or access denied');
        }

        $statement = WorkOrderStatement::where('work_order_id', $id)->first();

        if (! $statement) {
            return redirect()->route('work-orders.statement.show', $id)
                ->with('error', 'No statement found for this work order.');
        }

        $pdf = \PDF::loadView('pdf.statement', [
            'work_order' => $workOrder,
            'statement' => $statement,
        ]);

        $filename = 'statement_WO-' . str_pad($workOrder['id'], 6, '0', STR_PAD_LEFT) . '_' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }

    protected function generateStatementNumber(): string
    {
        $latestId = WorkOrderStatement::max('id') ?? 0;
        $next = $latestId + 1;

        return 'SOA-' . str_pad((string) $next, 6, '0', STR_PAD_LEFT);
    }
}

