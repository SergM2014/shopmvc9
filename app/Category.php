<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private static $categories;



    public static function getVerticalMenu()
    {
        self::$categories = self::all();


        return self::printOutLeftMenu();


    }


//для выпадающего меню
    private static function printOutLeftMenu($parent = 0)
    {
        static $suffix = 1;
        if(!isset($print)){$print=''; }

        foreach(self::$categories as $category){
            if($category->parent_id ==$parent ){

                $print.='<li class="left-menu_li" data-category-id ='.$category->id.' data-parent-id='.$category->parent_id.'>
                 <div class="left-menu__item  nested-'.$suffix.'"  >
                 <a href="/category/'.$category->eng_translit_title.'" class="left-menu__link">'. $category->title .'</a>' ;

                foreach(self::$categories as $sub_cat){
                    if($sub_cat->parent_id == $category->id){ $flag = TRUE; break; }
                }

                if(isset($flag)){
                    $suffix=$suffix+1;
                    $print.= "<img src='/img/arrow_down.png' alt='' title='' class='left-menu__contains-subcatetegories-sign'  > </div> <ul class='hidden'>";
                    $print.= self::printOutLeftMenu($category->id);
                    $print.= "</ul>";
                    $print.= "</li>";
                    $flag = null;
                    $suffix = $suffix-1;
                } else{
                    $print.="</div></li>";
                }
            }
        }
        return $print;
    }





    public function products()
    {
        return $this->belongsToMany('App\Product');
    }


    public static function getLeftCatalogMenu()
    {
        self::$categories = self::all();


        $leftMenu = self::printOutlLeftCatalogMenu();

        return $leftMenu;
    }


    protected static function printOutlLeftCatalogMenu(  $parent = 0)
    {
        if(!isset($print)){$print='';}
        foreach(self::$categories as $category){
            if($category->parent_id ==$parent ){

                $print.='<li  class="left-catalog-menu__item"><a href="/category/'. $category->eng_translit_title .'" class="left-catalog-menu__link">'.$category->title.'</a>' ;
                foreach(self::$categories as $sub_cat){
                    if($sub_cat->parent_id == $category->id){
                        $flag = TRUE; break;
                    }
                }

                if(isset($flag)){
                    $print.= "<ul>";
                    $print.= self::printOutlLeftCatalogMenu( $category->id);
                    $print.= "</ul>";
                    $print.= "</li>";
                } else{
                    $print.="</li>";
                }
            }
        }
        return $print;
    }


}
