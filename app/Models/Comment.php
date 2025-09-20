<?php

namespace App\Models;

use App\Models\ShareAction\ActiveAttrModel;
use App\Models\Types\CommentInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model implements CommentInterface
{
    use HasFactory;
    use ActiveAttrModel;

    /**
     * the attribute for mass inset.
     */
    protected $fillable = self::FILLED_FILEDS;

    /**
     * 
     */
    protected $guarded = [];

    /**
     * the attributes will be hidden.
     */
    protected $hidden = self::HIDDEN_FIELDS;

    /**
     * extend attribute for model
     * design name function: get[calmel case of attribute name]Attribute
     * example: getChildrenCountAttribute for: children_count || childrenCount
     */
    protected $appends = ['children_count']; // Add the custom attribute here

    /**
     * function for model.
     */
    protected static function booted(): void
    {
        
    }

    /**
     * get user info of the comment
     */
    public function user() : BelongsTo {
        return $this->belongsTo(User::class, CommentInterface::USER_ID);
    }

    public function children() : HasMany {
        return $this->hasMany($this, self::PARENT_ID, self::ID);
    }

    public function getChildrenCountAttribute() : int {
        return $this->children()->count();
    }

}
