<?php

namespace App\Models;

use App\Models\ShareAction\ActiveAttrModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContent extends Model
{
    use HasFactory;

    use SoftDeletes;
    use ActiveAttrModel;
    
}
