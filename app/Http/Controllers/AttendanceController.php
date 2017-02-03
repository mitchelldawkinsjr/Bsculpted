<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 2/2/17
 * Time: 7:28 PM
 */

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;


class AttendanceController
{

    public function index(Request $request)
    {
        if($request->route()->uri() == 'attend')
        {
            $classTypes = ClassType::all(['class_type_id','class_name','disabled'])->where('disabled','=',null);
            return view('attendance.attendance-client-insert',['classTypes' => $classTypes]);
        }else{
            $classTypes = ClassType::all(['class_type_id','class_name','disabled'])->where('disabled','=',null);
            return view('attendance.attendance',['classTypes' => $classTypes]);
        }
    }


    public function addToClass(Request $request)
    {
        $clientId = null;
        $className=null;
        $date = date('F j, Y, g:i a');
        $name = explode(' ',$request->input('name'));
        $clients = User::where('first_nm','=',$name[0])->where('last_nm','=',$name[1])->get();
        $classes = ClassType::where('class_type_id','=',$request->input('class'))->get();
        if($clients->count() == 1)
        {
            foreach ($clients as $client)
            {
                $clientId = $client->client_id;
                $name = $client->first_nm . ' ' . $client->last_nm;
            }
        }else{
            return null;
        }
        if($classes->count() == 1)
        {
            foreach ($classes as $class)
            {
                $className = $class->class_name;
            }
        }else{
            return null;
        }
        Attendance::create([
            'client_id' => $clientId,
            'class_type_id' => $request->input('class'),
        ]);
        return View::make('attendance.attendance-inserted',['name' => $name,'class' => $className,'date' => $date]);
    }




}