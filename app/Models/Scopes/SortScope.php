<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class SortScope implements Scope
{
    /**
     * the scope for sort builder query of model.
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        /**
         * get all attributes of model table
         * @var array $modelAttributes
         */
        $modelAttributes = Schema::getColumnListing($model->getTable());
        /**
         * get orderBy attribute: in_array: $modelAttributes
         * exp: [id, name, title, created_at, updated_at, ...]
         */
        $orderBy = request()->query('order'); // attribute
        /**
         * get sortBy value: asc|desc
         */
        $sortBy = strtoupper(request()->query('sort'));
        /**
         * check if has: $orderBy
         * check if $orderBy attribute in list field of model
         * check if $sortBy value === asc || desc
         */
        if ($orderBy && in_array($orderBy, $modelAttributes) && in_array($sortBy, ['ASC', 'DESC'])) {
            $builder->orderBy($orderBy, $sortBy);
        }
    }
}
