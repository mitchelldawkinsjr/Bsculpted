<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Attendance;
use App\Models\User;
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
        $totalClients = $this->totalClientsCrated();
        $totalClassesAttendedThisMonth = $this->totalClassesAttendedThisMonth();
        return view('home',['totalClients' => $totalClients,'totalClasses' => $totalClassesAttendedThisMonth]);
    }

    public function totalClientsCrated()
    {
        $clients = User::all();
        return $clients->count();
    }

    public function totalClassesAttendedThisMonth()
    {
        $startOfCurrentMonth = date('Y-01-m 00:00:00');
        $endOfCurrentMonth = date('Y-t-m 12:59:59');
        $classesTotal = Attendance::all()->where(['created'],'>',$startOfCurrentMonth)->where(['created'],'<',$endOfCurrentMonth);
        return $classesTotal->count();
    }


}
