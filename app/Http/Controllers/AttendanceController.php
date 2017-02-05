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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;



class AttendanceController
{

    /**
     * @param Request $request
     * @return Redirect|View
     */
    public function index(Request $request)
    {
        if($request->route()->uri() == 'attend')
        {
            return view('attendance.attendance-client-insert',['classTypes' => $this->getClassTypes(),'notification' => null]);
        }else{
            if (Auth::check()) {
                $classTypes = ClassType::all(['class_type_id', 'class_name', 'disabled'])->where('disabled', '=', null);
                return view('attendance.attendance',['classTypes' => $this->getClassTypes(),'unfilteredAttendance' => $this->listAllAttendanceContents(),'notification' => null]);
            }else{
                return redirect('/');
            }
        }
    }

    /**
     * @return static
     */
    public function getClassTypes(){
        return $classTypes = ClassType::all(['class_type_id','class_name','disabled','created'])->where('disabled','=',null);
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function addClass(Request $request)
    {
        if(Auth::check()){
            $notification = null;
            $classModel = new ClassType();
            $classModel->class_name = $request->class_name;
            $saved = $classModel->save();
            if(!$saved){
                App::abort(500, 'Error');
            } else {
                $notification = 'Success, ' . $request->class_name . ' was added as a new class.';
            }
        }else {
            return redirect('/');
        }
        return View::make('attendance.attendance', ['classTypes' => $this->getClassTypes(),'unfilteredAttendance' => $this->listAllAttendanceContents(),'notification' => $notification]);
    }

    /**
     * @param Request $request
     * @return Redirect|null
     */
    public function addToClass(Request $request)
    {
        if (Auth::check()) {
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

            $user = Auth::user()->get();

            if($user[0]->admin== 't')
            {
                $notification = 'Success,'.$className.','.$name;
                return View::make('attendance.attendance',['classTypes' => $this->getClassTypes(),'unfilteredAttendance' => $this->listAllAttendanceContents(),'notification' => $notification]);
            }else{
                return View::make('attendance.attendance-inserted',['name' => $name,'class' => $className,'date' => $date,'notification' => null]);
            }
        }
        return redirect('/');

    }

    /**
     * @return mixed
     */
    public function listAllAttendanceContents()
    {
        $attendance = DB::table('attendance')
            ->join('clients','attendance.client_id','=','clients.client_id')
            ->join('class_types','attendance.class_type_id','=','class_types.class_type_id')
            ->select('attendance.attendance_id','clients.first_nm','clients.last_nm','class_types.class_name','attendance.created')
            ->get();
        return $attendance;

    }

    /**
     * @return Redirect
     */
    public function deleteSuccess(){
        if (Auth::check()) {
            $notification = 'Removal, The record(s) were removed';
            return View::make('attendance.attendance', ['classTypes' => $this->getClassTypes(), 'unfilteredAttendance' => $this->listAllAttendanceContents(), 'notification' => $notification]);
        } else {
            return redirect('/');
        }
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function deleteClassType(Request $request)
    {
        if (Auth::check()) {
            $notification = null;
            $data = $request->all();
            foreach($data as $k) {
                $count = count($k);
                foreach ($k as $v) {
                    $record = ClassType::find($v['id']);
                    $record->delete();
                }
                $notification = null;
            }
            return View::make('attendance.attendance', ['classTypes' => $this->getClassTypes(),'unfilteredAttendance' => $this->listAllAttendanceContents(),'notification' => $notification]);
        } else {
            return redirect('/');
        }
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function deleteAttendance(Request $request)
    {
        if (Auth::check()) {
            $notification = null;
            $data = $request->all();
            foreach($data as $k) {
                $count = count($k);
                foreach ($k as $v) {
                    $record = Attendance::find($v['id']);
                    $record->delete();
                }
                $notification = null;
            }
            return View::make('attendance.attendance', ['classTypes' => $this->getClassTypes(),'unfilteredAttendance' => $this->listAllAttendanceContents(),'notification' => $notification]);
        } else {
            return redirect('/');
        }
    }

}