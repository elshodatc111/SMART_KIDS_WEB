<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Kid;
use App\Models\KidPayment;
use App\Models\LeadEmployee;
use App\Models\LeadKid;
use App\Models\MoliyaHistory;
use App\Models\User;
use App\Models\UserPaymart;

class ReportController extends Controller{
    public function hodimVakansiyalari(){
        $leads = LeadEmployee::get();
        return view('report.hodim_vakansiya', compact('leads'));
    }
    public function qabulArizalar(){
        $leads = LeadKid::get();
        return view('report.bolalar_arizalari',compact('leads'));
    }
    public function barchaGuruhlar(){
        $leads = Group::get();
        return view('report.barcha_guruhlar', compact('leads'));
    }
    public function barchaBolalar(){
        $leads = Kid::get();
        return view('report.barcha_bolalar', compact('leads'));
    }
    public function barchaNolalarTolovlari(){
        $leads = KidPayment::get();
        return view('report.bolalar_tolovlari',compact('leads'));
    }
    public function barchaHodimlar(){
        $leads = User::get();
        return view('report.barcha_hodimlar',compact('leads'));
    }
    public function barchaHodimIshHaqlari(){
        $leads = UserPaymart::get();
        return view('report.hodimlar_ish_haqlari',compact('leads'));
    }
    public function moliyaTarixi(){
        $leads = MoliyaHistory::get();
        return view('report.balans_tarixi',compact('leads'));
    }
}
