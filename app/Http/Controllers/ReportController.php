<?php

namespace App\Http\Controllers;

use App\Models\LeadEmployee;
use Illuminate\Http\Request;

class ReportController extends Controller{
    public function hodimVakansiyalari(){
        $leads = LeadEmployee::get();
        return view('report.hodim_vakansiya', compact('leads'));
    }
    public function qabulArizalar(){
        return view('report.bolalar_arizalari');
    }
    public function barchaGuruhlar(){
        return view('report.barcha_guruhlar');
    }
    public function barchaBolalar(){
        return view('report.barcha_bolalar');
    }
    public function barchaNolalarTolovlari(){
        return view('report.bolalar_tolovlari');
    }
    public function barchaHodimlar(){
        return view('report.barcha_hodimlar');
    }
    public function barchaHodimIshHaqlari(){
        return view('report.hodimlar_ish_haqlari');
    }
    public function moliyaTarixi(){
        return view('report.balans_tarixi');
    }
}
