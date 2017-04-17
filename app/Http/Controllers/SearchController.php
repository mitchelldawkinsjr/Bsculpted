<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 2/2/17
 * Time: 10:21 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class SearchController
{
    public function autocomplete()
    {
        $term = Input::get('term');

        $results = array();

        $queries = DB::table('clients')
            ->where('first_nm', 'LIKE', '%' . $term . '%')
            ->orWhere('last_nm', 'LIKE', '%' . $term . '%')
            ->take(5)->get();

        foreach ($queries as $query) {
            $results[] = ['id' => $query->client_id, 'value' => $query->first_nm . ' ' . $query->last_nm];
        }
        return response()->json($results);
    }
}