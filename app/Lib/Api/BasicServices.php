<?php

namespace App\Lib\Api;

/**
 * Created by PhpStorm.
 * User: maetheechokkuchantorn
 * Date: 10/16/2015 AD
 * Time: 5:03 PM
 */
use App\Http\Requests\Request;
use Input;
use \Exception;

class BasicServices extends CoreAbstract {

    public function items($r) {

        $method = $r->getMethod();

        switch ($method) {

            case'GET':  
            
              //  throw new Exception('user not found.');
                $user = '';
                return self::parseValue($user);
                
                break;
            case'POST':

                break;
            case'PUT':

                break;
            case'DELETE':

                break;
        }
    }

}
