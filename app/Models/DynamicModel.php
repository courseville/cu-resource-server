<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicModel extends Model
{
    protected $guarded = [];

    public function setTableName($table)
    {
        $this->setTable($table);

        return $this;
    }
}
