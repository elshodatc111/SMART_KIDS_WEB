<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupKid;
use App\Models\Kid;
use App\Models\KidDavomad;
use Illuminate\Http\Request;

class KidDavomadController extends Controller{
    public function showAllGroups(){
        $now = now()->format('Y-m-d');
        $res = Group::where('status', 'active')
            ->withCount(['groupKids as child_count' => function ($query) {
                $query->where('status', 'active');
            }])
            ->addSelect(['davomad_status' => KidDavomad::selectRaw('count(*)')
                ->whereColumn('group_id', 'groups.id')
                ->whereDate('attendance_date', $now)
                ->limit(1)
            ])
            ->get();
        return view('kid.davomad', compact('res'));
    }

    public function show($id){
        $group = Group::findOrFail($id);
        $kids = Kid::whereHas('groupKids', function($q) use ($id) {
            $q->where('group_id', $id)->where('status', 'active');
        })->get();
        $months = [
            'current' => now(),
            'last' => now()->subMonth()
        ];
        $attendanceData = [];
        foreach ($months as $key => $month) {
            $daysInMonth = $month->daysInMonth;
            $year = $month->year;
            $monthNum = $month->month;
            $attendances = KidDavomad::where('group_id', $id)
                ->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $monthNum)
                ->get()
                ->groupBy(['kid_id', function ($item) {
                    return (int)$item->attendance_date->format('d');
                }]);
            $attendanceData[$key] = [
                'month_name' => $month->translatedFormat('F, Y'),
                'days_count' => $daysInMonth,
                'data' => $attendances
            ];
        }
        return view('kid.davomad_show', compact('group', 'kids', 'attendanceData'));
    }

    public function storeAttendance(Request $request){
        $validated = $request->validate([
            'group_id' => 'required',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
        ]);
        foreach ($validated['attendance'] as $kidId => $status) {
            KidDavomad::updateOrCreate(
                [
                    'group_id' => $validated['group_id'],
                    'kid_id' => $kidId,
                    'attendance_date' => $validated['attendance_date'],
                ],
                [
                    'status' => $status,
                    'created_id' => auth()->id(),
                ]
            );
        }
        return back()->with('success', __('kid_davomad_page.success'));
    }
}
