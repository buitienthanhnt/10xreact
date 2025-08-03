<?php

namespace App\Models;

use App\Events\WriterSaved;
use App\Models\Types\PageInterface;
use App\Models\Types\WriterInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Writer extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [WriterInterface::IMAGE_PATH];

    /**
     * khai báo lắng nghe cho các sự kiện thực hiện với Model:
     * saved, updated, deleting, and deleted
     */
    protected $dispatchesEvents = [
        'saved' => WriterSaved::class,
        // 'deleted' => UserDeleted::class,
    ];

    /**
     * khai báo sự kiện cho các hành động trong hàm booted.
     * bằng cách này có thể áp dụng hàm số closure trực tiếp;
     * ngoài ra có thể đăng ký trong biến: $dispatchesEvents bên trên
     */
    protected static function booted()
    {
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

    /**
     * format data of model after get or set action
     * https://laravel.com/docs/12.x/eloquent-mutators#defining-an-accessor
     * https://laravel.com/docs/12.x/eloquent-mutators#defining-a-mutator
     */
    function active(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value ? __('attrval.active') : __('attrval.inactive');
            },
            set: fn(mixed $value) => $value == 'on' ? true : false,
        );
    }
}
