<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        $from = Carbon::now()->subDays(7);
        $to = Carbon::now();
        $transactions = Transaction::with('category')->get();
        $data['labels'] = $transactions->map(function ($transaction){
            return $transaction->category->name;
        })->unique();

        $data['prices'] = $transactions->groupBy('category_id')->map(function ($group){
            return $group->sum('amount');
        })->values();

        $groupedTransactions = $transactions->groupBy('category_id');

        // Map expenses and incomes to the same order as labels
        $data['expenses'] = $data['labels']->map(function ($label) use ($groupedTransactions) {
            $category = $groupedTransactions->first(function ($group) use ($label) {
                return optional($group->first()->category)->name === $label;
            });
            return $category ? $category->where('type', 'expense')->sum('amount') : 0;
        });

        $data['incomes'] = $data['labels']->map(function ($label) use ($groupedTransactions) {
            $category = $groupedTransactions->first(function ($group) use ($label) {
                return optional($group->first()->category)->name === $label;
            });
            return $category ? $category->where('type', 'income')->sum('amount') : 0;
        });

        $data['user'] = Auth::user();
        $data['total_expense'] = Transaction::with('user')->where('type','expense')->sum('amount');
        $data['total_income'] = Transaction::with('user')->where('type','income')->sum('amount');
        $data['lastWeekTransactions'] = Transaction::with(['category','attachment'])->whereBetween('date',[$from,$to])->get();
        return view('user.dashboard',$data);
    }

    public function fetchData(Request $request){

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $transactions = Transaction::with('category')
                        ->whereBetween('date',[$startDate,$endDate])
                        ->get();

        $data['labels'] = $transactions->map(function($transaction){
            return $transaction->category->name;
        })->unique()->values();

        $data['prices'] = $transactions->groupBy('category_id')->map(function($transaction){
            return $transaction->sum('amount');
        })->values();

        $groupedTransactions = $transactions->groupBy('category_id');

        $data['expenses'] = $data['labels']->map(function($label) use ($groupedTransactions){
            $category = $groupedTransactions->first(function($group) use ($label){
                return optional($group->first()->category)->name === $label;
            });
            return $category ? $category->where('type','expense')->sum('amount') : 0;
        });

        $data['incomes'] = $data['labels']->map(function($label) use ($groupedTransactions){
            $category = $groupedTransactions->first(function($group) use ($label){
                return optional($group->first()->category)->name === $label;
            });
            return $category ? $category->where('type','income')->sum('amount') : 0;
        });

        return response()->json($data);
    
    }
}
