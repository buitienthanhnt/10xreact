<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    const ATTR_TITLE = 'title';
    const ATTR_SHORT_DESC = 'short_desc';
    const ATTR_ACTIVE = 'active';
    const ATTR_ST_ID = 'st_id';
}
