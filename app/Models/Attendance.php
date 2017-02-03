<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 2/2/17
 * Time: 9:06 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $table = 'attendance';

    protected $primaryKey = 'attendance_id';

    protected $orderBy = 'attendance_id:ASC';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id','class_type_id'
    ];
}