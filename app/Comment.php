<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'product_id',
        'parent_id',
        'name',
        'email',
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

               $print.= "<li>
                            <div class='comment_item'>
                            <div class='avatar_comment-block'>
                           <span class='text-warning'> Name:</span>  $comment->name <br>";

                            $avatarImage = $comment->avatar? "/uploads/avatars/$comment->avatar" : "/img/noavatar.jpg";

                              $print.= " <img src= $avatarImage alt='' class='comment_avatar'>
                            <br>
                            
                           <span class='text-warning'> Added at: </span> $comment->created_at ";

            $print.="</div>
                    
    
    
    
            <div class='text_comment-block'>
                 $comment->comment 
            </div>
            <div class='clearfix'></div>
                 <div class='response_btn-container'>
                    <button type='button' class='btn-xs pull-right give_response-btn'
                     data-parent-id='{$comment->parent_id}' data-comment-id='{$comment->id}'>Give Response</button>
                </div>
            </div>      ";

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

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
