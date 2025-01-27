<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BillController extends Controller
{
    public function index(){
        $data['bills'] = Bill::where('user_id',Auth::id())->get();
        return view('user.bills.bills',$data);
    }

    public function create(){
        return view('user.bills.add-bill');
    }

    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'paid' => 'required',
                'recurring' => 'required',
                'recurring_period' => 'required_if:recurring,1',
            ],
            [
                'name.required' => 'Bill Name is required',
                'amount.required' => 'Amount is required',
                'date.required' => 'Date is required',
                'paid.required' => 'This field is required',
                'recurring.required' => 'This field is required',
                'recurring_period.required_if' => 'Recurring period is required when Recurring is yes',
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try{
            $bill = Bill::create([
                'name' => $request->name,
                'user_id' => Auth::id(),
                'due_date' => $request->date,
                'amount' => $request->amount,
                'is_paid' => $request->paid,
                'is_recurring' => $request->recurring,
                'recurring_interval' => $request->recurring_period,
            ]);
            DB::commit();
            return to_route('user.bills')->with('success','New Bill added to list');
        }catch(Throwable $exception){
            DB::rollBack();
            Log::error('Bill create error:', ['exception' => $exception->getMessage()]);
            return back()->with('error','Something went wrong');
        }
    }

    public function edit($id){
        $billId = base64_decode($id);
        $data['bill'] = Bill::where('id',$billId)->first();
        return view('user.bills.edit-bill',$data);
    }

    public function update(Request $request,$id){
        $billId = base64_decode($id);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'amount' => 'required',
                'date' => 'required',
                'paid' => 'required',
                'recurring' => 'required',
                'recurring_period' => 'required_if:recurring,1',
            ],
            [
                'name.required' => 'Bill Name is required',
                'amount.required' => 'Amount is required',
                'date.required' => 'Date is required',
                'paid.required' => 'This field is required',
                'recurring.required' => 'This field is required',
                'recurring_period.required_if' => 'Recurring period is required when Recurring is yes',
            ]
        );

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try{
            $bill = Bill::where('id',$billId)->update([
                'name' => $request->name,
                'user_id' => Auth::id(),
                'due_date' => $request->date,
                'amount' => $request->amount,
                'is_paid' => $request->paid,
                'is_recurring' => $request->recurring,
                'recurring_interval' => $request->recurring_period,
            ]);
            DB::commit();
            return to_route('user.bills')->with('success','Bill updated successfully');
        }catch(Throwable $exception){
            DB::rollBack();
            Log::error('Bill update error:', ['exception' => $exception->getMessage()]);
            return back()->with('error','Something went wrong');
        }

    }

    public function destroy($id){
        $billId = base64_decode($id);
        try{
            Bill::where('id',$billId)->delete();
            return back()->with('success','Bill deleted successfully');
        }catch(Throwable $exception){
            Log::error('Bill delete error:', ['exception' => $exception->getMessage()]);
            return back()->with('error','Something went wrong');
        }
    }

    public function markNotificationAsRead(Request $request){
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($request->notification_id);
        $notification->markAsRead();
        return response()->json(['status' => 'success']);
    }
}
