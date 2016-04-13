<?php

namespace App\Lib\Api;

class CoreAbstract {

    public function parseValue($object = false) {

        if (!$object || !is_object($object))
            return false;

        if (get_class($object) === 'App\Item') {

            $item = array('id' => $object->getKey()
                , 'name' => $object->name
                , 'description' => $object->last_name
            );

            //   $item = array('id' => $object->getKey(), 'name' => $object->name, 'first_name' => $object->first_name,'last_name' => $object->last_name , 'photo' =>url($object->photo));
        } else {

            $item = $object;
        }

        return $item;
    }

    public function parseList($list) {

        $r = array('total' => $list->total(),
            'per_page' => $list->perPage(),
            'current_page' => $list->currentPage(),
            'last_page' => $list->lastPage(),
            'next_page_url' => $list->nextPageUrl(),
            'prev_page_url' => $list->previousPageUrl(),
            'from' => $list->firstItem(),
            'to' => $list->lastItem());

        $items = array();
        foreach ($list as $item) {

            $items[] = self::parseValue($item);
        }
        $r['data'] = $items;

        return $r;
    }

    public function parseItems($list) {
        $items = $list->items;
        $new_items = array();
        foreach ($list->items as $item) {
            $new_items[] = self::parseValue($item);
        }

        $list->items = $new_items;
        return $list;
    }

}
