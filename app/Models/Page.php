<?php

namespace App\Models;

use App\Helper\StringHelper;
use App\Models\Scopes\ActiveScope;
use App\Models\Scopes\SortScope;
use App\Models\ShareAction\ActiveAttrModel;
use App\Models\ShareAction\FormField;
use App\Models\Types\PageInterface;
use App\Models\Types\WriterInterface;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[ScopedBy([ActiveScope::class])]
#[ScopedBy([SortScope::class])]
class Page extends Model implements PageInterface
{
    /**
     * default trait
     */
    use HasFactory;
    use SoftDeletes;

    /**
     * custom trait
     */
    use FormField;
    use ActiveAttrModel;

    /**
     * The attributes that aren't mass assignable.
     * các thuộc tính không cho phép gán hàng loạt.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     * các thuộc tính cho phép gán hàng loạt.
     *
     * @var array<int, string>
     */
    protected $fillable = self::FILLED_FILEDS;

    /**
     * thuộc tính cần cho: FormField trait để lấy form update field.
     */
    protected $formFields = self::FORM_FIELDS;

    /**
     * return writer model of page.
     * function name same as const of interface.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WriterInterface::TABLE_NAME, self::WRITER);
    }

    /**
     * value for select option field.
     * hàm này sử dụng trong form field dạng select option
     * định dạng tên hàm: {tên key}.'Options'.
     * ví dụ: select field có name là writer thì tên hàm của model page là: 'writer'.'Options' = writerOptions
     */
    public static function writerOptions(): array
    {
        $listWriter = Writer::all();
        return array_map(function (array $writer) {
            return [
                'value' => $writer[WriterInterface::ID],
                'label' => $writer[WriterInterface::NAME],
            ];
        }, $listWriter->toArray());
    }

    /**
     * @return Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function imagePath(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return Attribute::make(
            get: function (string|null $value) {
                return $value ? asset($value) : '';
            },
            set: function (string|null $value) {
                // array [
                //   "scheme" => "http"
                //   "host" => "adoc.dev"
                //   "path" => "/storage/files/uploads/261479696_1820281014826477_6400419339212881138_n_084353.jpg"
                // ]
                return $value ? parse_url($value)['path'] : null;
            },
        );
    }

    public function alias(): Attribute
    {
        return Attribute::make(set: function (string $input) {
            return Str::snake(StringHelper::vn_to_str($input, true), '-');
        });
    }
}
