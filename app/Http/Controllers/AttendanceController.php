<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 2/2/17
 * Time: 7:28 PM
 */

namespace App\Http\Controllers;

use App\Common\ClientCheckIn;
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
use Netshell\Paypal\Facades\Paypal;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Symfony\Component\HttpKernel\Client;
use Zjango\Curl\Facades\Curl;


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
            return view('attendance.attendance-dashboard',[
                'classTypes' => $this->getClassTypes(),
                'unfilteredAttendance' => $this->listAllAttendanceContents(),
                'attendanceByClass'=>$this->attendanceByClass(),
                'topClass'=>$this->topAttendedClass(),
                'topClients' => $this->listTopAttendeesForMonth(),
                'totalClients' => $this->totalClientsCrated(),
                'totalClasses' => $this->totalClassesAttendedThisMonth()
            ]);
        }
    }

    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request)
    {
        if($request->route()->uri() == 'attendance/client-insert')
        {
            return view('attendance.attendance/client-insert',['classTypes' => $this->getClassTypes()]);
        }else{
            return view('attendance.attendance-edit',[
                'classTypes' => $this->getClassTypes(),
                'unfilteredAttendance' => $this->listAllAttendanceContents(),
                'attendanceByClass'=>$this->attendanceByClass(),
            ]);
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
        $data = null;
        $r=null;
        $clients = null;
        $clientId = null;
        $className = null;
        $redirectRoute = null;
        $date = date('F j, Y');
        $name = explode(' ', $request->input('name'));
        $barcode = $request->input('barcode');
        if(count($name) > 1 || !empty($barcode))
        {
            if(!($name[0] == ""))
            {
                $clients = User::where('first_nm','=',$name[0])->where('last_nm','=',$name[1])->get();
            } else {
                $clients = User::where('client_id','=',$barcode)->get();
            }

            if($clients->count() == 1)
            {

                foreach ($clients as $client)
                {
                    $clientId = $client->client_id;
                    $name = $client->first_nm . ' ' . $client->last_nm;
                }

                $classes = ClassType::where('class_type_id','=',$request->input('class'))->get();
                if($classes->count() == 1)
                {
                    foreach ($classes as $class)
                    {
                        $className = $class->class_name;
                    }
                    if($className & $clientId)
                    {
                        Attendance::create([
                            'client_id' => $clientId,
                            'class_type_id' => $request->input('class'),
                        ]);

                        if($request->is('attendance/addToClass'))
                        {
                            $client = User::where('client_id','=',$clientId)->get();
                            foreach ($client as $c)
                            {
                                $email = $c->email_nm;
                            }
                            $r = PaypalController::getLastestPaymentByEmail($email);
                        }
                    }
                } else {
                    return redirect()->back()->with('message', statusHelper::format_message('error','There was an error while adding the client to a class. Please try again.'));
                }
            } else {
                return redirect()->back()->with('message', statusHelper::format_message('error','This client does not exist OR there are multiple clients with the same first and last name.'));
            }
        } else {
            return redirect()->back()->with('message', statusHelper::format_message('error','This client does not exist'));
        }
        return redirect()->back()->with(
            [
                'message' => statusHelper::format_message('success' , $name . ' was successfully added to '. $className . ' on ' .$date, $r,false),
            ]);
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
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function addClassType(Request $request)
    {
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
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function deleteClassType(Request $request)
    {
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
            session()->flash('message',statusHelper::format_message('error' ,'The was an error while removed record. Please refresh the page and try again.'));
        }
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function success(Request $request)
    {
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
    }

    /**
     * @param Request $request
     * @return Redirect
     */
    public function deleteAttendance(Request $request)
    {
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
        $timestamp = strtotime("first day of");
        $startOfCurrentMonth  = date("Y-m-d 00:00:00", $timestamp);

        $timestampEnd = strtotime("last day of");
        $endOfCurrentMonth = date("Y-m-d 00:00:00", $timestampEnd);

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
        $timestamp = strtotime("first day of");
        $startOfCurrentMonth  = date("Y-m-d 00:00:00", $timestamp);

        $timestampEnd = strtotime("last day of");
        $endOfCurrentMonth = date("Y-m-d 00:00:00", $timestampEnd);

        $top = DB::table('attendance')
            ->select(DB::raw('count(attendance.class_type_id) as count, class_name'))
            ->join('class_types','class_types.class_type_id','=','attendance.class_type_id')
            ->where('attendance.created','>',$startOfCurrentMonth)
            ->where('attendance.created','<',$endOfCurrentMonth)
            ->groupBy('class_types.class_name')
            ->orderBy('count','desc')
            ->limit(1)
            ->get();
        if($top->count() == 0)
        {
            $class = new \stdClass();
            $class->class_name ='N/A';
            $class->count = 0;
            $top->push($class);
        }
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
        $timestamp = strtotime("first day of");
        $startOfCurrentMonth  = date("Y-m-d 00:00:00", $timestamp);

        $timestampEnd = strtotime("last day of");
        $endOfCurrentMonth = date("Y-m-d 00:00:00", $timestampEnd);

        $classesTotal = Attendance::all()->where(['created'],'>',$startOfCurrentMonth)->where(['created'],'<',$endOfCurrentMonth);
        return $classesTotal->count();
    }

    /**
     * @return mixed
     */
    public function graphNumbers()
    {
        $byClassMonth = DB::table('attendance')
            ->select(DB::raw('count(attendance.class_type_id) as count, MONTH(CURRENT_DATE()) as month'))
            ->join('class_types','class_types.class_type_id','=','attendance.class_type_id')
            ->get();
        return response()->json([$byClassMonth]);
    }

}