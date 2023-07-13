<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RfidApiController extends \App\Http\Controllers\Controller
{

    use ApiResponse;
    public function index($string)
    {
        Cache::put('rfid',$string,now()->addMinutes(15));
        return $this->responseWithSuccess(__('rfid has receive'));
    }

    public function show(Request $request){
        $rfid = Cache::pull('rfid');
        if (empty($rfid)){
            return $this->responseWithError("کارت rfid به دستگاه نزدیک کنید.",code: 422);
//            return $this->responseWithError(__('custom.Waite_for_rfid'),code: 422);

        }
        return $this->responseWithSuccess($rfid);

    }
}
