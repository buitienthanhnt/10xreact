<?php

namespace App\Models;

use App\Models\Types\PageInterface;
use App\Models\Types\WriterInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Page extends Model implements PageInterface 
{
    use HasFactory;

    /**
     * return writer model of page.
     * function name same as const of interface.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer() : \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(WriterInterface::TABLE_NAME, self::WRITER);
    }
}
