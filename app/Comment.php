<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'product_id',
        'parent_id',
        'avatar',
        'comment',
        'published',
        'changed'
    ];



    public static function getCommentsTreeStructure($parent, $comments)
    {
       $print = '';
       foreach ($comments as $comment){

           if($comment->parent_id == $parent){

               $print.= "<li class='list-group-item'><span>{$comment->comment}</span>";

               foreach ($comments as $subcomment){
                   if($subcomment->parent_id == $comment->id) { $flag = true;}
               }

               if(isset($flag)){
                   $print.= "<ul>";
                   $print.= self::getCommentsTreeStructure($comment->id, $comments);
                   $print.= "</ul>";
                   $print.= "</li>";
                   $flag = null;
               } else {
                   $print.= "</li>";
               }
           }
       }

       return $print;
    }
}
