<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

/*
  Services
 */
use App\Lib\Api\BasicServices;

class ServicesController extends Controller {

    public $_debug = true;

    /**
     * Pattern this result return with rest api
     *
     * @var json
     */
    public static function responeFormat($statuscode = 404, $message, $data) {

        $result = array('code' => $statuscode, 'message' => $message, 'data' => $data);
        return response()->json($result, $statuscode);
    }

    /**
     * Pattern this error return with rest api
     *
     * @var json
     */
    public static function errorFormat($statuscode = 404, $message) {

        $result = array('code' => $statuscode, 'error' => $message);
        return response()->json($result, $statuscode);
    }

    /**
     * sample api with insert , update , delete
     *
     * @var json
     */
    public function basic(Request $r, $version = '1', $api = 'items') {

        $service = new BasicServices();

     
        try {
            switch ($api) {
                case'items':

                    $results = $service->items($r);

                    break;
                default:
                    return $this->errorFormat(404, 'Api not declare.');
                    break;

                    DB::commit();
                    return $this->responeFormat(200, 'success', $results);
            }
        } catch (Exception $e) {
            DB::rollBack();
            if ($this->_debug) {
                $message = $e->getMessage();
            } else {
                $message = 'Error by case';
            }

            return $this->errorFormat(404, $message);
        }
    }

}
