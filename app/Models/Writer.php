<?php

namespace App\Models;

use App\Events\WriterSaved;
use App\Models\Types\PageInterface;
use App\Models\Types\WriterInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Writer extends Model
{
    use HasFactory;

    /**
     * khai báo lắng nghe cho các sự kiện thực hiện với Model:
     * saved, updated, deleting, and deleted
     */
    protected $dispatchesEvents = [
        'saved' => WriterSaved::class,
        // 'deleted' => UserDeleted::class,
    ];

    protected static function booted() {
        /**
         * register event listen for closure. 
         */
        // static::saved(function (Writer $writer) : void {
        //     Log::info('listen after saved writer of page: '.$writer->{WriterInterface::NAME});
        // });
    }

    /**
     * return page collection of writer
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PageInterface::TABLE_NAME, PageInterface::WRITER);
    }

}
