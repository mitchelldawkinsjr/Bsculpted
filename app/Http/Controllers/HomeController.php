<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Attendance_For_Current_Month_List;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Client;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home',['attendanceByClass'=>$this->attendanceByClass(),'topClass'=>$this->topAttendedClass(),'topClients' => $this->listTopAttendeesForMonth(),'totalClients' => $this->totalClientsCrated(),'totalClasses' => $this->totalClassesAttendedThisMonth()]);
    }

    public function totalClientsCrated()
    {
        $clients = User::all();
        return $clients->count();
    }

    public function attendanceByClass(){
        $startOfCurrentMonth = date('Y-01-m 00:00:00');
        $endOfCurrentMonth = date('Y-t-m 12:59:59');
        $byClass = DB::table('attendance')
            ->select(DB::raw('count(attendance.class_type_id) as count, class_name'))
            ->join('class_types','class_types.class_type_id','=','attendance.class_type_id')
            ->where('attendance.created','>',$startOfCurrentMonth)
            ->where('attendance.created','<',$endOfCurrentMonth)
            ->groupBy('class_types.class_name')
            ->orderBy('count','desc')
            ->get();
        return $byClass;
    }

    public function topAttendedClass()
    {
        $startOfCurrentMonth = date('Y-01-m 00:00:00');
        $endOfCurrentMonth = date('Y-t-m 12:59:59');
        $top = DB::table('attendance')
            ->select(DB::raw('count(attendance.class_type_id) as count, class_name'))
            ->join('class_types','class_types.class_type_id','=','attendance.class_type_id')
            ->where('attendance.created','>',$startOfCurrentMonth)
            ->where('attendance.created','<',$endOfCurrentMonth)
            ->groupBy('class_types.class_name')
            ->orderBy('count','desc')
            ->limit(1)
            ->get();
        return $top;
    }

    public function listTopAttendeesForMonth(){
        return Attendance_For_Current_Month_List::all()->sortByDesc('count');
    }

    public function totalClassesAttendedThisMonth()
    {
        $startOfCurrentMonth = date('Y-01-m 00:00:00');
        $endOfCurrentMonth = date('Y-t-m 12:59:59');
        $classesTotal = Attendance::all()->where(['created'],'>',$startOfCurrentMonth)->where(['created'],'<',$endOfCurrentMonth);
        return $classesTotal->count();
    }


}
