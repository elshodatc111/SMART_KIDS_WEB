<?php

namespace App\Http\Controllers;

class ChartController extends Controller{
    public function tulovlar(){
        return view('chart.chart_paymart');
    }
    public function davomad(){
        return view('chart.chart_davomad');
    }
    public function chart(){
        return view('chart.chart');
    }
}
