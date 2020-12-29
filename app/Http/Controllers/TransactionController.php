<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::groupBy('code')->orderBy('id', 'DESC')->get();
        return view('admin.transaction.index', compact('transaction'));
    }
}
