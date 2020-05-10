<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models
 *
 * @property int $id
 * @property string $uid
 * @property string $name
 * @property boolean $active
 * @property int $sort
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class City extends Model
{
    public $primaryKey = 'uid';
    public $keyType = 'string';
}
