<?php


namespace App\Services;



use App\Models\Menu\Menu;
use Illuminate\Support\Facades\Cache;

class MenuServices
{




    public static function getMenu($HTTP_HOST,$languageID,$position = 0, $parent_id = 0, $parents = [], $params = [])
    {

        $params = [
            'ul_class' => (isset($params['ul_class']) && !empty($params['ul_class']) ? $params['ul_class'] : "ul_class"),
            'li_class' => (isset($params['li_class']) && !empty($params['li_class']) ? $params['li_class'] : "li_class"),
            'a_class' => (isset($params['a_class']) && !empty($params['a_class']) ? $params['a_class'] : "a_class"),
        ];

        //Aktiv dilleri aldim
        Cache::rememberForever('menu-all-'.$languageID.'-'.$position, function () use ($languageID,$position) {
            return Menu::where('languages.status', 1)
                ->where('languages.id', $languageID)
//                ->where('menus.menu_position_id', $position)
                ->where(function ($query) use ($position){
                    //0 ci indexi yoxlayir where olduqu uchun
                    $query->where('position->0', $position);
                    foreach (config('menu.menu_position') as $key => $menuPosition):
                        //o dan sonraki qalan indexleri yoxlayir orWhere() ile
                        if($key != 0){
                            $query->orWhere('position->'.$key, $position);
                        }
                    endforeach;

                })

                ->join('menu_positions', 'menus.menu_position_id', '=', 'menu_positions.id')
                ->join('menu_translations', 'menus.id', '=', 'menu_translations.menu_id')
                ->join('languages', 'languages.id', '=', 'menu_translations.language')
                ->select(
                    'menu_translations.*',
                    'menus.id',
                    'menus.sort',
                    'menus.menu_position_id',
                    'menus.parent',
                    'languages.id as languageID',
                    'languages.default as languageDefault',
                    'menu_positions.position as position'
                )
                ->orderBy('sort','ASC')
                ->get()->toArray();
        });


        if ($parent_id == 0) {
            foreach (cache('menu-all-'.$languageID.'-'.$position) as $element) {
                if (($element['parent'] != 0) && !in_array($element['parent'], $parents)) {
                    $parents[] = $element['parent'];
                }
            }
        }
        $menu_html = '';

        foreach (cache('menu-all-'.$languageID.'-'.$position) as $element) {




            if ($element['parent'] == $parent_id) {
                if (in_array($element['id'], $parents)) {

                    $isActive = str_replace($HTTP_HOST,'',url()->full()) == $element['link'] ? " active" : null;
                    $menu_html .= '<li class="class="'. $params['li_class'] . $isActive .'">';

                    $menu_html .= '<a class="'. $params['a_class'] .'" href="'.$element['link'].'">' . $element['label'] . '</a>';

                } else {

                    $isActive = str_replace($HTTP_HOST,'',url()->full()) == $element['link'] ? " active " : null;
                    $menu_html .= '<li class="'. $params['li_class'] . $isActive .'">';

                    $menu_html .= '<a class="'. $params['a_class'] .'" href="'.$element['link'].'" >' . $element['label'] . '</a>';
                }
                if (in_array($element['id'], $parents)) {
                    $menu_html .= '<ul class="'. $params['ul_class'] .'">';
                    $menu_html .= self::getMenu($HTTP_HOST,$languageID,$position, $element['id'], $parents);
                    $menu_html .= '</ul>';
                }
                $menu_html .= '</li>';
            }
        }
        return $menu_html;




    }


    public static function getFooterMenu($languageID,$position)
    {
        return Menu::where('languages.status', 1)
            ->where('languages.id', $languageID)
//            ->where('menus.menu_position_id', $position)
            ->where(function ($query) use ($position){
                //0 ci indexi yoxlayir where olduqu uchun
                $query->where('position->0', $position);
                foreach (config('menu.menu_position') as $key => $menuPosition):
                    //o dan sonraki qalan indexleri yoxlayir orWhere() ile
                    if($key != 0){
                        $query->orWhere('position->'.$key, $position);
                    }
                endforeach;

            })

            ->where('menus.parent', 0)
            ->join('menu_positions', 'menus.menu_position_id', '=', 'menu_positions.id')
            ->join('menu_translations', 'menus.id', '=', 'menu_translations.menu_id')
            ->join('languages', 'languages.id', '=', 'menu_translations.language')
            ->select(
                'menu_translations.*',
                'menus.id',
                'menus.sort',
                'menus.menu_position_id',
                'menus.parent',
                'languages.id as languageID',
                'languages.default as languageDefault',
                'menu_positions.position as position',
            )
            ->orderBy('sort','ASC')
            ->get();
//        @dd($test);
    }



}
