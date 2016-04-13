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
use Validator;

/* Models */
use App\Models\Item;

class BasicServices extends CoreAbstract {

    public function items($r) {

        $method = $r->getMethod();

        switch ($method) {
 
            case'GET':

                $page = $r->input('page', 0);
                $limit = (int) $r->input('limit', 10);
                $list = Item::skip($page)->paginate($limit);
                return self::parseList($list);

                break;
            case'POST':
                
           
                $v = Validator::make($r->input(), [
                            'name' => 'required|max:255',
                            'email' => 'required|email|max:255|unique:users',
                ]);

                if ($v->fails()) {
                    //Exception
                    throw new \Exception($v->errors());
                } else {

                    $item = new Item();
                    $item->name = $r->input('name');
                    $item->email = $r->input('email');
                    $item->descriptions = $r->input('descriptions');
                    $item->save();
                    return self::parseValue($item);
                }
                break;
            case'PUT':

                $v = Validator::make($r->input(), [
                            'id' => 'required',
                            'name' => 'required|max:255',
                            'email' => 'required|email|max:255|unique:users',
                ]);

                if ($v->fails()) {
                    //Exception
                    throw new \Exception($v->errors());
                } else {

                    $item = Item::find($r->input('id'));

                    if (!is_object($item)) {
                        throw new \Exception('Item not found');
                    }

                    $item->name = $r->input('name');
                    $item->email = $r->input('email');
                    $item->descriptions = $r->input('descriptions');
                    $item->save();
                    return self::parseValue($item);
                }

                break;
            case'DELETE':

                $v = Validator::make($r->input(), [
                            'id' => 'required',
                ]);

                if ($v->fails()) {
                    //Exception
                    throw new \Exception($v->errors());
                } else {

                    $item = Item::find($r->input('id'));

                    if (!is_object($item)) {
                        throw new \Exception('Item not found');
                    }
                    $item->delete();
                    return true;
                }


                break;
        }
    }

}
