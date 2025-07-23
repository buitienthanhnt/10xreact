<?php

namespace App\Models;

use App\Models\Types\PageInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements PageInterface 
{
    use HasFactory;
}
