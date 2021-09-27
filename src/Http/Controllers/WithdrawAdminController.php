<?php

namespace Modules\Wallet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Wallet\Models\Withdraw;

class WithdrawAdminController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::paginate();

        return view('wallet::withdraw.index', compact('withdraws'));
    }

    public function cancel(Withdraw $withdraw)
    {
        $withdraw->status = 'cancelled';
        $withdraw->save();

        return json_encode(['status' => 1]);
    }

    public function complete(Withdraw $withdraw)
    {
        $withdraw->status = 'completed';
        $withdraw->save();

        return json_encode(['status' => 1]);
    }
}
