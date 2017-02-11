<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 2/2/17
 * Time: 7:28 PM
 */

namespace App\Http\Controllers;

use App\Event\Status;
use App\Listeners\StatusNotification;
use App\Models\Attendance;
use App\Models\ClassType;
use App\Models\User;
use App\StatusHelper\statusHelper;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\HomeController;
use App\Models\Attendance_For_Current_Month_List;


class AttendanceController
{
    /**
     * @param Request $request
     * @return Redirect|View
     */
    public function index(Request $request)
    {
        if($request->route()->uri() == 'attendance/client-insert')
        {
            return view('attendance.attendance-client-insert',['classTypes' => $this->getClassTypes()]);
        }else{
            if (Auth::check()) {
                return view('attendance.attendance-dashboard',[
                    'classTypes' => $this->getClassTypes(),
                    'unfilteredAttendance' => $this->listAllAttendanceContents(),
                    'attendanceByClass'=>$this->attendanceByClass(),
                    'topClass'=>$this->topAttendedClass(),
                    'topClients' => $this->listTopAttendeesForMonth(),
                    'totalClients' => $this->totalClientsCrated(),
                    'totalClasses' => $this->totalClassesAttendedThisMonth()
                ]);
            }else{
                return redirect('/');
            }
        }
    }

    public function edit(Request $request)
    {
        if($request->route()->uri() == 'attendance/client-insert')
        {
            return view('attendance.attendance/client-insert',['classTypes' => $this->getClassTypes()]);
        }else{
            if (Auth::check()) {
                return view('attendance.attendance-edit',[
                    'classTypes' => $this->getClassTypes(),
                    'unfilteredAttendance' => $this->listAllAttendanceContents(),
                    'attendanceByClass'=>$this->attendanceByClass(),
                ]);
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
     * @return Redirect|null
     */
    public function addToClass(Request $request)
    {
        if (Auth::check()) {
            $clientId = null;
            $className = null;
            $redirectRoute = null;
            $date = date('F j, Y');
            $name = explode(' ',$request->input('name'));
            if(count($name) > 1)
            {
                $clients = User::where('first_nm','=',$name[0])->where('last_nm','=',$name[1])->get();
                if($clients->count() == 1)
                {
                    $classes = ClassType::where('class_type_id','=',$request->input('class'))->get();
                    foreach ($clients as $client)
                    {
                        $clientId = $client->client_id;
                        $name = $client->first_nm . ' ' . $client->last_nm;
                    }
                } else {
                    return redirect()->back()->with('message', statusHelper::format_message('error','This client does not exist'));
                }
            }else{
                return redirect()->back()->with('message', statusHelper::format_message('error','This client does not exist'));
            }
            if($classes->count() == 1)
            {
                foreach ($classes as $class)
                {
                    $className = $class->class_name;
                }
            }else{
                return redirect()->back()->with('message', statusHelper::format_message('error','There was an error while adding the client to a class. Please refresh the page and try again.'));
            }

            Attendance::create([
                'client_id' => $clientId,
                'class_type_id' => $request->input('class'),
            ]);
             // to do restirct the redirect to route attendance only if user is admin
//            $user = Auth::user()->get();
//            if($user[0]->admin== 't') {}
            return redirect()->back()->with('message', statusHelper::format_message('success' , $name . ' was successfully added to '. $className . ' on ' .$date));

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
            return View::make('attendance.attendance-dashboard',[
                'classTypes' => $this->getClassTypes(),
                'unfilteredAttendance' => $this->listAllAttendanceContents(),
                'attendanceByClass'=>$this->attendanceByClass(),
                'topClass'=>$this->topAttendedClass(),
                'topClients' => $this->listTopAttendeesForMonth(),
                'totalClients' => $this->totalClientsCrated(),
                'totalClasses' => $this->totalClassesAttendedThisMonth()
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function addClassType(Request $request)
    {
        if(Auth::check()){
            $notification = null;
            $classModel = new ClassType();
            $classModel->class_name = $request->class_name;
            if($request->class_name)
            {
                $saved = $classModel->save();
            } else {
                return Redirect::back()->with('message', statusHelper::format_message('error','You cannot use this name please try again.'));
            }
            if(!$saved){
                return Redirect::back()->with('message', statusHelper::format_message('error','The was an error while adding the class. Please refresh the page and try again.'));
            } else {
                return Redirect::back()->with('message', statusHelper::format_message('success' , $request->class_name .' was added as a new class.') );
            }
        }else {
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
            $result = false;
            $data = $request->all();
            foreach($data as $k) {
                $count = count($k);
                foreach ($k as $v) {
                    $record = ClassType::find($v['id']);
                    $result = $record->delete();
                }
            }
            if($result)
            {
                session()->flash('message',statusHelper::format_message('success' ,' You Removed ' . $count . ' record(s)'));
            } else {
                session()->flash('message',statusHelper::format_message('error' ,'The was an error while removed record. Please refreh the page and try again.'));
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function success(Request $request)
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
            return View::make('attendance.attendance-dashboard',[
                'classTypes' => $this->getClassTypes(),
                'unfilteredAttendance' => $this->listAllAttendanceContents(),
                'attendanceByClass'=>$this->attendanceByClass(),
                'topClass'=>$this->topAttendedClass(),
                'topClients' => $this->listTopAttendeesForMonth(),
                'totalClients' => $this->totalClientsCrated(),
                'totalClasses' => $this->totalClassesAttendedThisMonth()
            ]);
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
            $result = false;
            $data = $request->all();
            foreach($data as $k) {
                $count = count($k);
                foreach ($k as $v) {
                    $record = Attendance::find($v['id']);
                    $result = $record->delete();
                }
            }
            if($result)
            {
                session()->flash('message',statusHelper::format_message('success' ,' You Removed ' . $count . ' record(s)'));
            } else {
                session()->flash('message',statusHelper::format_message('error' ,'The was an error while removing the record(s). Please refresh the page and try again.'));
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * @return int
     */
    public function totalClientsCrated()
    {
        $clients = User::all();
        return $clients->count();
    }

    /**
     * @return mixed
     */
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

    /**
     * @return mixed
     */
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

    /**
     * @return mixed
     */
    public function listTopAttendeesForMonth(){
        return Attendance_For_Current_Month_List::all()->sortByDesc('count');
    }

    /**
     * @return mixed
     */
    public function totalClassesAttendedThisMonth()
    {
        $startOfCurrentMonth = date('Y-01-m 00:00:00');
        $endOfCurrentMonth = date('Y-t-m 12:59:59');
        $classesTotal = Attendance::all()->where(['created'],'>',$startOfCurrentMonth)->where(['created'],'<',$endOfCurrentMonth);
        return $classesTotal->count();
    }

    public function graphNumbers()
    {
        $byClassMonth = DB::table('attendance')
            ->select(DB::raw('count(attendance.class_type_id) as count, month(attendance.created) as month, class_name'))
            ->join('class_types','class_types.class_type_id','=','attendance.class_type_id')
            ->groupBy('month')
            ->get();
        return response()->json(['data' => $byClassMonth]);
    }

}