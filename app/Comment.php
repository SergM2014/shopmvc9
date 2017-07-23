<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'product_id',
        'parent_id',
        'name',
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

               $print.= "<div class='parent_comment-block'>
                           <span class='text-warning'> Name:</span>  $comment->name 
                            <br>
                           <span class='text-warning'> Added at: </span> $comment->created_at ";

            if($comment->avatar){

                $print.= " <img src='/uploads/avatars/$comment->avatar' alt=''>";

            }

            $print.="</div>
    
    
    
            <div class='parent_comment-block'>
                 $comment->comment 
            </div>
            <div class='clearfix'>
                 <button type='button' class='btn-xs pull-right give_response-btn'
                 data-parent-id='{$comment->parent_id}' data-comment-id='{$comment->id}'>Give Response</button>
            
            </div>
                        
                          ";

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
