<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTypeForm extends Model
{
    use HasFactory;

    /**
     * Get the forms for the type of form
     *
     * @return void
     */
    public function forms()
    {
        $this->hasMany(Form::class);
    }
}
