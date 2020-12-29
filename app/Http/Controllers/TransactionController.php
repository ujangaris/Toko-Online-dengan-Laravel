<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::groupBy('code')->orderBy('id', 'DESC')->get();
        return view('admin.transaction.index', compact('transaction'));
    }

    public function status($code, $status)
    {
        if ($status == 0) {
            $change = '1';
        } else {
            $change = '0';
        }

        $transaction = Transaction::where('code', $code)->pluck('id')->toArray();
        Transaction::whereIn('id', $transaction)->update(['status' => $change]);
        Alert::success('', 'Status pembayaran berhasil diperbaharui!');

        return redirect('admin/transaction');
    }
}
