<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * auto increment
     *
     * @var boolean
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'status',
        'start_time',
        'end_time',
        'reason',
        'user_id',
        'm_type_form_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    /**
     * Get the user that owns the form.
     *
     * @return void
     */
    public function user()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the form.
     *
     * @return void
     */
    public function mTypeForm()
    {
        $this->belongsTo(MTypeForm::class, 'm_type_form_id');
    }
}
