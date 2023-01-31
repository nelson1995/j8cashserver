<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /*
     * @return  api users recent transactions
     * */
    public function recentTransactions(Request $request)
    {
        $userTransactions = User::query()->where('id',$request->user()->id)
            ->with('airtime','deposits','transfers')->latest('updated_at')->get();

        return response()->json($userTransactions);
    }
}
