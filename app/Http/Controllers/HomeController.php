<?php

namespace App\Http\Controllers;

use App\Models\GroupKid;
use App\Models\GroupPaymart;
use App\Models\Kid;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller{

    protected function payGroup($kid_id, $monch, $group_id, $amount){
        DB::transaction(function () use ($kid_id, $monch, $group_id, $amount) {
            GroupPaymart::create([
                'kid_id'   => $kid_id,
                'group_id' => $group_id,
                'monch'    => Carbon::parse($monch)->startOfMonth(), 
                'amount'   => $amount
            ]);
            $kid = Kid::findOrFail($kid_id);
            $kid->decrement('amount', $amount);
            $kid->update([
                'payment_month' => $monch
            ]);
        });
    }

    protected function checkPaymart(){
        $currentMonth = now()->format('Y-m');
        $groupKids = GroupKid::with(['kid', 'group'])->where('status', 'active')->get();
        foreach ($groupKids as $item) {
            $kid = $item->kid;
            if ($kid && $kid->payment_month !== $currentMonth) {
                if($item->group->group_amount>0){
                    $this->payGroup(
                        $item->kid_id, 
                        $currentMonth, 
                        $item->group_id, 
                        $item->group->group_amount
                    );
                }
            }
        }
    }

    public function home(){
        $this->checkPaymart(); // Bolaning guruhlar uchun to'lovini teksirish
        return view('index');
    }

}
