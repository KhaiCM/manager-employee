<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            if (strpos($query->sql, 'select * from "jobs" where') === 0) {
                return;
            }

            $time = sprintf('[Time: %dms] ', $query->time);
            $sql = $query->sql;
            if (config('app.env') !== 'production') {
                $wrapped = str_replace('?', "'?'", $sql);
                $sql = str_replace_array('?', $query->bindings, $wrapped);

                $sql = str_replace('?, ', '', $sql);
                $sql = str_replace('(?), ', '', $sql);

                if (mb_strlen($sql) > 102400) {
                    $sql = str_replace('?, ', '', $query->sql);
                    $sql = str_replace('(?), ', '', $sql);
                    return Log::info($time . $sql);
                }

                return Log::info($time . $sql);
            }

            return Log::info($time . $sql);
        });
    }
}
