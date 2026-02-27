<?php

namespace App\Http\Controllers;
use App\Models\KidPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller{

    public function tulovlar(){
        $joriyOyData = $this->getPieChartData(now());
        $otganOyData = $this->getPieChartData(now()->subMonth());
        $kunlik = [];
        $kunlikDates = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $kunlikDates[] = now()->subDays($i)->format('d-M');
            $kunlik['cash'][] = $this->getAmountByDay($date, 'payment', 'cash');
            $kunlik['card'][] = $this->getAmountByDay($date, 'payment', 'card');
            $kunlik['bank'][] = $this->getAmountByDay($date, 'payment', 'bank');
            $kunlik['discount'][] = $this->getAmountByDay($date, 'discount');
            $kunlik['return'][] = $this->getAmountByDay($date, 'return');
        }
        $oylik = [];
        $oylikLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $oylikLabels[] = $month->format('M');
            $oylik['cash'][] = $this->getAmountByMonth($month, 'payment', 'cash');
            $oylik['card'][] = $this->getAmountByMonth($month, 'payment', 'card');
            $oylik['bank'][] = $this->getAmountByMonth($month, 'payment', 'bank');
            $oylik['discount'][] = $this->getAmountByMonth($month, 'discount');
            $oylik['return'][] = $this->getAmountByMonth($month, 'return');
        }
        return view('chart.chart_paymart', compact('joriyOyData', 'otganOyData', 'kunlik', 'kunlikDates', 'oylik', 'oylikLabels'));
    }

    private function getPieChartData($date) {
        $data = KidPayment::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->selectRaw("
                SUM(CASE WHEN payment_type = 'payment' AND payment_method = 'cash' THEN amount ELSE 0 END) as cash,
                SUM(CASE WHEN payment_type = 'payment' AND payment_method = 'card' THEN amount ELSE 0 END) as card,
                SUM(CASE WHEN payment_type = 'payment' AND payment_method = 'bank' THEN amount ELSE 0 END) as bank,
                SUM(CASE WHEN payment_type = 'discount' THEN amount ELSE 0 END) as discount,
                SUM(CASE WHEN payment_type = 'return' THEN amount ELSE 0 END) as returns
            ")->first();
        return [
            (float)($data->cash ?? 0),
            (float)($data->card ?? 0),
            (float)($data->bank ?? 0),
            (float)($data->discount ?? 0),
            (float)($data->returns ?? 0)
        ];
    }

    private function getAmountByDay($date, $type, $method = null) {
        $q = KidPayment::whereDate('created_at', $date)->where('payment_type', $type);
        if ($method) $q->where('payment_method', $method);
        return (int) $q->sum('amount');
    }

    private function getAmountByMonth($month, $type, $method = null) {
        $q = KidPayment::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->where('payment_type', $type);
        if ($method) $q->where('payment_method', $method);
        return (int) $q->sum('amount');
    }

    public function aktive(){
        $monthlyActiveData = [];
        $monthLabels = [];
        for ($i = 11; $i >= 0; $i--) {
            $monthDate = now()->subMonths($i);
            $month = $monthDate->month;
            $year = $monthDate->year;
            $monthLabels[] = $monthDate->format('M');
            $maxAttendance = DB::table('kid_davomads')
                ->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month)
                ->where('status', 'keldi')
                ->select('attendance_date', DB::raw('count(*) as daily_count'))
                ->groupBy('attendance_date')
                ->orderByDesc('daily_count')
                ->first();
            $monthlyActiveData[] = $maxAttendance ? (int)$maxAttendance->daily_count : 0;
        }
        return view('chart.chart_active', [
            'monthlyActiveData' => json_encode($monthlyActiveData),
            'monthLabels' => json_encode($monthLabels)
        ]);

    }

    public function varonka(){
        
        return view('chart.chart_varonka');
    }
    public function chart(){
        return view('chart.chart');
    }
}
