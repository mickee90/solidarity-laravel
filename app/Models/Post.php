<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $city_id
 * @property int $type_id
 * @property string $title
 * @property string $ingress
 * @property string $content
 * @property string $email
 * @property string $phone
 * @property string $website
 * @property boolean $published
 * @property Carbon $deleted_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 *
 */
class Post extends Model
{
    public $fillable = [
        'title',
        'ingress',
        'content',
        'email',
        'phone',
        'website',
        'published',
        'type_id'
    ];

    public $casts = [
        'published' => 'boolean'
    ];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
