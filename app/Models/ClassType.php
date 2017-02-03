<?php
/**
 * Created by PhpStorm.
 * User: ussignalmitchelldawkins
 * Date: 2/2/17
 * Time: 7:51 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $table = 'class_types';

    protected $primaryKey = 'class_type_id';

    protected $orderBy = 'class_type_id:ASC';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_name','disabled'
    ];
}