<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupKid;
use App\Models\GroupPaymart;
use App\Models\HodimDavomad;
use App\Models\Kid;
use App\Models\KidDavomad;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    protected function kidDavomad(){
        $keldi = count(HodimDavomad::where('attendance_date',date('Y-m-d'))->wherein('status',['keldi','kechikdi'])->get());
        $kechikdi = count(HodimDavomad::where('attendance_date',date('Y-m-d'))->where('status','kechikdi')->get());
        $davomad = count(HodimDavomad::where('attendance_date',date('Y-m-d'))->get());
        return [
            'keldi' =>$keldi,
            'kechikdi' =>$kechikdi,
            'davomad' => $davomad>0?true:false,
        ];
    }

    public function guruhDavomad(){
        $group = Group::where('status','active')->get();
        $count = 0;
        $now = date("Y-m-d");
        foreach ($group as $key => $value) {
            $check = KidDavomad::where('group_id',$value->id)->where('attendance_date',$now)->first();
            if(!$check){
                $count = $count + 1;
            }
        }
        return [
            'guruhlar' => count($group),
            'davomadsiz' => $count
        ];
    }

    protected function kunlikDavomad(){
        $dates = [];
        for ($i = 9; $i >= 0; $i--) {$dates[] = now()->subDays($i)->toDateString();}
        $stats = DB::table('kid_davomads')->where('attendance_date', '>=', $dates[0])
            ->select(
                DB::raw("DATE(attendance_date) as date"), 
                'status', 
                DB::raw('count(*) as total')
            )->groupBy('date', 'status')->get();
        $keldiData = [];
        $kelmadiData = [];
        foreach ($dates as $date) {
            $keldi = $stats->where('date', $date)->where('status', 'keldi')->first();
            $keldiData[] = $keldi ? (int)$keldi->total : 0;
            $kelmadi = $stats->where('date', $date)->where('status', 'kelmadi')->first();
            $kelmadiData[] = $kelmadi ? (int)$kelmadi->total : 0;
        }
        return [
            'keldi' => $keldiData,
            'kelmadi' => $kelmadiData
        ];
    }

    public function home(){
        $this->checkPaymart(); // Bolaning guruhlar uchun to'lovini teksirish
        $hodimlar = count(User::where('status','active')->where('type','!=','drektor')->get());
        $davomad = $this->kidDavomad();
        $aktivKid = count(Kid::where('status','true')->get());
        $guruhDavomad = $this->guruhDavomad();
        $chart = $this->kunlikDavomad();
        return view('index',compact('hodimlar','davomad','aktivKid','guruhDavomad','chart'));
    }

}
