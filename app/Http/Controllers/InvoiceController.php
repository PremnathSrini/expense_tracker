<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class InvoiceController extends Controller
{
    public function generateInvoice()
    {
        $data['invoice'] = $invoice = Invoice::create([
            'invoice_number' => 'INV' . Carbon::now()->format('Ym') . rand(1000, 9999),
            'bill_id' => 1,
            'due_date' => Carbon::today(),
            'amount' => 239.49,
            'status' => '0'
        ]);

        // $qrData = "UEN: SVision123, Invoice: {$invoice->invoice_number}, Amount: {$invoice->amount}";

        // $qrPath = "invoices/qrcode_{$invoice->invoice_number}.png";
        // $qrFullPath = public_path($qrPath);

        // file_put_contents($qrFullPath, QrCode::format('png')->size(200)->generate($qrData));

        // $pdf = Pdf::loadView('user.invoices.pdf', compact('invoice', 'qrPath'));

        // $pdfPath = "invoices/{$invoice->invoice_number}.pdf";
        // Storage::put("public/{$pdfPath}", $pdf->output());

        // $invoice->update([
        //     'pdf_path' => $pdfPath,
        // ]);

        // return response()->json(['message' => 'Invoice Generated', 'invoice' => $invoice]);
        $uen = '123456789A'; // Replace with actual UEN
        $qrData = "UEN: $uen\nInvoice No: {$invoice->invoice_number}\nAmount: {$invoice->amount}";

        $qrCode = base64_encode(QrCode::format('svg')->size(150)->generate($qrData));

        $pdf = Pdf::loadView('user.invoices.pdf', compact('invoice', 'qrCode'));
        $pdfFileName = 'invoices/' . $invoice->invoice_number . '.pdf';

        Storage::disk('public')->put($pdfFileName, $pdf->output());

        $invoice->update(['pdf_path' => $pdfFileName]);

        return back()->with('success', 'Invoice created successfully!');
    }
}
