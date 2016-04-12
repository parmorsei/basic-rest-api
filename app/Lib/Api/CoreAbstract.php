<?php
namespace App\Lib\Api;

class CoreAbstract
{
    
    public function parseValue($object = false) {
        
        if(!$object || !is_object($object))
            return false;

        if(get_class($object) === 'App\User' || get_class($object) === 'User') {

            $item = array('id' => $object->getKey()
            , 'name' => $object->name
            , 'first_name' => $object->first_name
            , 'last_name' => $object->last_name
            , 'cover' =>url($object->getCover())
            , 'photo' =>url($object->getPhoto())
            , 'sizes' => array(
                    'icon'=>url($object->getPhoto('icon')),
                    'small'=>url($object->getPhoto('small')),
                    'large'=>url($object->getPhoto('large')),
                )
            );

           //   $item = array('id' => $object->getKey(), 'name' => $object->name, 'first_name' => $object->first_name,'last_name' => $object->last_name , 'photo' =>url($object->photo));

        }elseif(get_class($object) === 'App\Models\Videos\Video'){

            $item = $object;
            $item->stream = $item->getStreamUrl();
            $item->thumbnail_url = $item->getThumbnail();
            $item->url = $item->getLink();

        }elseif(get_class($object) === 'App\Models\Users\Chemi'){


            $item = $object;
            $item->levels = ChemiLevel::getLevel($item);

        }elseif(get_class($object) === 'App\Models\Users\ChemiLog'){

            $chemi = Chemi::where('u_id','=',$object->u_id)
                ->where('celeb_id','=',$object->celeb_id)
                ->first();
            
            $item = $object;
            $item->levels = ChemiLevel::getLevel($chemi);

        }else{

            $item = $object;

        }

        return $item;

    }

    public function parseList($list ) {

        $r = array('total'  => $list->total(),
            'per_page'      => $list->perPage(),
            'current_page'  => $list->currentPage(),
            'last_page'     => $list->lastPage(),
            'next_page_url' => $list->nextPageUrl(),
            'prev_page_url' => $list->previousPageUrl(),
            'from'          => $list->firstItem(),
            'to'            => $list->lastItem());

        $items = array();
        foreach($list as $item){

            $items[] = self::parseValue($item);

        }
        $r['data'] = $items;

        return $r;

    }

    public function parseItems($list)
    {
        $items = $list->items;
        $new_items = array();
        foreach ($list->items as $item) {
            $new_items[] = self::parseValue($item);
        }

        $list->items = $new_items;
        return $list;
    }



}