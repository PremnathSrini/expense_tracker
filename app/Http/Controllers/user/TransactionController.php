<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TransactionController extends Controller
{

    public $attachmentId = null;

    public function index()
    {
        $data['transactions'] = $transactions = Transaction::with(['attachment', 'category'])->get();
        // foreach($transactions as $transaction){
        //     dd($transaction->type);
        // }
        return view('user.transactions.transactions', $data);
    }

    public function create()
    {
        $data['categories'] = Category::all();
        return view('user.transactions.add-transactions', $data);
    }

    public function store(Request $request)
    {
        $attachmentId = null;
        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'type' => 'required',
                'category' => 'required',
                'invoice' => 'sometimes|mimes:doc,docx,pdf,jpg,jpeg,png',
            ],
            [
                'description.required' => 'Description is required',
                'amount.required' => 'Amount is required',
                'date.required' => 'Date is required',
                'type.required' => 'Type is required',
                'category.required' => 'Category is required',
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            if ($request->has('invoice')) {
                $date = date('Ymd');
                $invoiceName = $date . '_' . $request->invoice->getClientOriginalName();
                $request->invoice->move(public_path('invoices'), $invoiceName);

                $attachment = Attachment::create([
                    'name' => $invoiceName,
                ]);
                $attachmentId = $attachment->id;
            }
            $transaction = Transaction::create([
                'description' => $request->description,
                'amount' => $request->amount,
                'date' => $request->date,
                'type' => $request->type,
                'category_id' => $request->category,
                'attachment_id' => $attachmentId,
                'user_id' => Auth::id(),
                'other_text' => $request->other_text ?? null,
            ]);
            DB::commit();
            return to_route('user.transactions')->with('success', 'Transaction Added');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('transaction add error' . $e->getMessage());
            return back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        $transactionId = base64_decode($id);
        $data['transaction'] = Transaction::where('id', $transactionId)->first();
        $data['categories'] = Category::all();
        return view('user.transactions.edit-transaction', $data);
    }

    public function update(Request $request, $id)
    {
        $attachmentId = null;
        $transactionId = base64_decode($id);

        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'type' => 'required',
                'category' => 'required',
                'invoice' => 'sometimes|mimes:doc,docx,pdf,jpg,jpeg,png',
            ],
            [
                'description.required' => 'Description is required',
                'amount.required' => 'Amount is required',
                'date.required' => 'Date is required',
                'type.required' => 'Type is required',
                'category.required' => 'Category is required',
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $oldDbFile = Transaction::with('attachment')->findOrFail($transactionId);

            if ($request->has('invoice')) {
                $date = date('Ymd');
                $newFile = $date . '_' . $request->invoice->getClientOriginalName();
                $request->invoice->move(public_path('invoices'), $newFile);

                if ($oldDbFile->attachment && $oldDbFile->attachment->name) {
                    $oldFilePath = public_path('invoices/' . ($oldDbFile->attachment->name ?? ''));
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $attachment = $oldDbFile->attachment_id
                    ? Attachment::where('id', $oldDbFile->attachment_id)->update(['name' => $newFile])
                    : Attachment::create(['name' => $newFile]);

                $attachmentId = $attachment->id ?? $oldDbFile->attachment_id;
            } else {
                $attachmentId = $oldDbFile->attachment_id;
            }

            $oldDbFile->update([
                'description' => $request->description,
                'amount' => $request->amount,
                'date' => $request->date,
                'type' => $request->type,
                'category_id' => $request->category,
                'attachment_id' => $attachmentId,
                'other_text' => $request->other_text ?? null,
            ]);

            DB::commit();
            return to_route('user.transactions')->with('success', 'Transaction Updated Successfully');
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('transaction update error ' . $e->getMessage());
            return $e->getMessage();
        }
    }
}
