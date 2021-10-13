<?php

namespace App\Http\Controllers;

use Validator;


class PingPongController extends Controller {

    public function ping() {
        return response()->json('Pong');
    }
}
