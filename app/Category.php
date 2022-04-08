<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Middleware\LocaleMiddleware;

class Category extends Model
{
    protected $fillable = [
      'parent_id', 'title'
    ];

    private static $categories;

    private static function setCategories(): void
    {
        self::$categories = self::all();
    }

    public static function getVerticalMenu(): string
    {
        self::setCategories();

        return self::printOutLeftMenu();
    }

    private static function printOutLeftMenu(int $parent = 0): string
    {
        static $suffix = 1;
        if(!isset($print)){$print=''; }

        foreach(self::$categories as $category){
            if($category->parent_id ==$parent ){

                $print.='<li class="left-menu_li" data-category-id ='.$category->id.
                        ' data-parent-id='.$category->parent_id.'>
                         <div class="left-menu__item  nested-'.$suffix.'"  >
                         <a href="/'.LocaleMiddleware::printLink().'/catalog/category/'.$category->title.
                         '" class="left-menu__link">'. $category->title .'</a>' ;

                foreach(self::$categories as $sub_cat){
                    if($sub_cat->parent_id == $category->id){ $flag = TRUE; break; }
                }

                if(isset($flag)){
                    $suffix=$suffix+1;
                    $print.= "<img src='/img/arrow_down.png' alt='' title='' 
                                class='left-menu__contains-subcatetegories-sign'  > </div> <ul class='hidden'>";
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


    public static function getLeftCatalogMenu(): string
    {
        self::setCategories();

        $leftMenu = self::printOutlLeftCatalogMenu();

        return $leftMenu;
    }

// left category menu for catalog page
    protected static function printOutlLeftCatalogMenu(int $parent = 0): string
    {
        if(!isset($print)){$print='';}
        foreach(self::$categories as $category){
            if($category->parent_id ==$parent ){

                $print.='<li  class="left-catalog-menu__item"><a href="/'.LocaleMiddleware::printLink().
                    '/catalog/category/'. $category->title .'" class="left-catalog-menu__link">'.$category->title.'</a>' ;
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

    public static function getCategoryDropDownList(array $selectedArray): string
    {
        self::getCategories();

        return self::printCategoryDropDownList($selectedArray);
    }


    private  static function printCategoryDropDownList(
        array $selected = null,
        int $parent = 0,
        string $prefix = ''
    ): string
    {
        $print = "";
        foreach (self::$categories as $category){

            if($category->parent_id == $parent){
                $print.= "<option value='{$category->id}'";

                $selectedOption = ($selected == $category->id OR @in_array($category->id, $selected))? 'selected': '';

                $print.= " $selectedOption >
                                {$prefix}{$category->title}
                          </option>";

                foreach(self::$categories as $subCategory){
                    if($subCategory->parent_id == $category->id){
                        $flag = true;
                    }
                }

                if(isset($flag)){
                    $prefix.='-';
                    $print.= self::printCategoryDropDownList( $selected, $category->id, $prefix);

                    $flag = null; $prefix = substr($prefix,0,-1);
                }
            }
        }

        return $print;
    }

    public static function getAdminCategoriesList(): string
    {
        self::getCategories();
        $leftMenu = self::printOutAdminCategoriesList();

        return $leftMenu;
    }

    protected static function printOutAdminCategoriesList(int $parent = 0): string
    {
        if (!isset($print)) $print='';
        foreach(self::$categories as $category){
            if($category->parent_id ==$parent ){

                $print.="<li  class='admin-category-menu__item ' data-category-id='$category->id' >
                            <span class='admin-category-menu__item-text'>$category->title</span>" ;
                foreach(self::$categories as $sub_cat){
                    if($sub_cat->parent_id == $category->id){
                        $flag = TRUE; break;
                    }
                }

                if(isset($flag)){
                    $print.= "<ul>";
                    $print.= self::printOutAdminCategoriesList( $category->id);
                    $print.= "</ul>";
                    $print.= "</li>";
                } else{
                    $print.="</li>";
                }
            }
        }

        return $print;
    }

    public static function getUpdateCategoryDropDownList(array $selectedArray, int $currentCategory): string
    {
        self::setCategories();

        return self::printUpdateCategoryDropDownList($selectedArray, $currentCategory);
    }


    private  static function printUpdateCategoryDropDownList(
        array $selected = null,
        int $currentCategory,
        int $parent = 0,
        string $prefix = ''
    ): string
    {
        $print = "";
        foreach (self::$categories as $category){

            if($currentCategory == $category->id) continue;

            if($category->parent_id == $parent){
                $print.= "<option value='{$category->id}'";

                $selectedOption = ($selected == $category->id OR @in_array($category->id, $selected))? 'selected': '';

                $print.= " $selectedOption >
                                {$prefix}{$category->title}
                          </option>";

                foreach(self::$categories as $subCategory){
                    if($subCategory->parent_id == $category->id){
                        $flag = true;
                    }
                }
                if(isset($flag)){
                    $prefix.='-';
                    $print.= self::printUpdateCategoryDropDownList( $selected, $currentCategory, $category->id, $prefix);

                    $flag = null; $prefix = substr($prefix,0,-1);
                }
            }
        }

        return $print;
    }
}