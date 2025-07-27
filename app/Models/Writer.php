<?php

namespace App\Models;

use App\Models\Types\PageInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Writer extends Model
{
    use HasFactory;

    /**
     * return page collection of writer
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PageInterface::TABLE_NAME, PageInterface::WRITER);
    }
}
