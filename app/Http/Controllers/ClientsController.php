<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\StatusHelper\statusHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use League\Flysystem\Exception;
use Milon\Barcode\DNS1D;

class ClientsController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        return View::make('clients.clients-dashboard',[
            'clients' => self::listClients(),
            'totalClients' => self::totalClientsCrated()
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function listClients()
   {
       return User::All();
   }

    /**
     * @return int
     */
    public static function totalClientsCrated()
    {
        $clients = User::all();
        return $clients->count();
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $result = false;
        $data = $request->all();
        foreach($data as $k) {
            $count = count($k);
            foreach ($k as $v) {
                $record = User::find($v['id']);
                if($record){
                    try {
                        $result = $record->delete();
                    } catch(\PDOException $e) {
                        $e->getMessage();
                        $result = false;
                    }
                }else{
                    $result = false;
                }
            }
        }
        if($result)
        {
            return session()->flash('message',statusHelper::format_message('success' ,' You Removed ' . $count . ' record(s)'));
        } else {
            return session()->flash('message',statusHelper::format_message('error' ,'The was an error while removing the record(s). Please refresh the page and try again. Make sure to remove all records related to this client before deleting.'));
        }

    }

    /**
     * @param Request $request
     */
    public function edit(Request $request)
    {
        $result = false;
        $record = User::find(Input::get('client-id'));

        if($record)
        {
            $record->first_nm = Input::get('first-name');
            $record->last_nm = Input::get('last-name');
            $record->email_nm = Input::get('email');
            $result = $record->save();
        }
        if($result)
        {
            return redirect()->back()->with('message',statusHelper::format_message('success' , Input::get('first-name') . ' has been updated'));
        } else {
            return redirect()->back()->with('message',statusHelper::format_message('error' ,'The was an error while removing the record(s). Please refresh the page and try again.'));
        }
    }

    /**
     * @param Request $request
     */
    public function add(Request $request)
    {
        $result = false;
        $add = true;

        $emailConstraint = User::where('email_nm', '=', $request->input('email_nm'))->get();

        foreach (Input::get() as $input) {
            if ($input == "") {
                $add = false;
            };
            if ($emailConstraint->count() >= 1) {
                $add = false;
            }
        }

        if ($add) {
            $result =
                User::create([
                    'first_nm' => $request->input('first_nm'),
                    'last_nm' => $request->input('last_nm'),
                    'email_nm' => $request->input('email_nm'),
                    'password' => bcrypt('password1')
                ]);

            $client = User::where('email_nm', '=', $request->input('email_nm'))->get();

            if ($client) {
                foreach ($client as $c) {
                    $clientId = $c->client_id;
                }
                self::assignSaveBarcode($clientId);
            }
        }
        if($result) {
            return redirect()->back()->with('message', statusHelper::format_message('success',  $request->input('first_nm') . ' ' . $request->input('last_nm')  . ' has been added'));
        } else {
            return redirect()->back()->with('message',statusHelper::format_message('error' ,'The was an error while add this record. Please refresh the page and try again.'));
        }
    }

    /**
     * @param $clientId
     * @return bool
     */
    public function assignSaveBarcode($clientId)
    {
        $b = new DNS1D();
        $barcode = $b->getBarcodePNGPath($clientId,'C39');
        if($barcode)
        {
            return true;
        }
        return false;
    }
}
