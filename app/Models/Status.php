<?php

namespace App\Models;

use Database\Factories\StatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class Status extends Model
{
    /** @use HasFactory<StatusFactory> */
    use HasFactory;

    protected $guarded = ['id'];
}
