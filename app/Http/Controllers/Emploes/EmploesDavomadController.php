<?php

namespace App\Http\Controllers\Emploes;

use App\Http\Controllers\Controller;
use App\Models\HodimDavomad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmploesDavomadController extends Controller{
    
    public function showDavomad(){
        $currentMonth = Carbon::now();
        $prevMonth = Carbon::now()->subMonth();
        $users = User::where('type','!=','drektor')->with(['attendances' => function($query) use ($currentMonth, $prevMonth) {
            $query->whereBetween('attendance_date', [
                $prevMonth->startOfMonth()->toDateString(), 
                $currentMonth->endOfMonth()->toDateString()
            ]);
        }])->get();
        $daysInCurrentMonth = $currentMonth->daysInMonth;
        $daysInPrevMonth = $prevMonth->daysInMonth;
        return view('davomad.emploes_davomad', compact(
            'users', 
            'currentMonth', 
            'prevMonth', 
            'daysInCurrentMonth', 
            'daysInPrevMonth'
        ));
    }

    public function store(Request $request){
        $request->validate([
            'attendances' => 'required|array',
            'attendance_date' => 'required|date',
        ]);
        foreach ($request->attendances as $userId => $status) {
            HodimDavomad::updateOrCreate(
                [
                    'user_id' => $userId,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'status' => $status,
                    'created_by' => auth()->id(),
                ]
            );
        }
        return back()->with('success', 'Bugungi davomat muvaffaqiyatli saqlandi!');
    }

}
