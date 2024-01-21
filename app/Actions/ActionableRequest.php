<?php

namespace App\Actions;

use Illuminate\Http\Request;

abstract class ActionableRequest
{
    abstract public function handle();

    /**
     * @see static::handle()
     */
    public static function run(Request $request, array $params = null)
    {
        return app(static::class)->handle($request, $params);
    }
}
