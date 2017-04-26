<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function getCatalog()
    {

        $startPage= ($this->page-1)*$this->amount;
        $this->order='';


        $order= $_GET['order']?? $_POST['order']?? null;

        $category = $_GET['category']?? $_POST['category']?? null;
        $manufacturer= $_GET['manufacturer']?? $_POST['manufacturer']?? null;



        switch( @ $order){
            case 'abc': $this->order=' ORDER BY `p`.`title` ASC'; break;
            case 'cba': $this->order=' ORDER BY `p`.`title` DESC'; break;
            case 'cheap_first': $this->order=' ORDER BY `p`.`price` ASC'; break;
            case 'expensive_first': $this->order= ' ORDER BY `p`.`price` DESC'; break;
            default: $this->order= ' ORDER BY `p`.`title` ASC'; break;
        }


        if(isset($category)){
            $this->category = $this->conn->quote($category);

            $this->category = "WHERE `c`.`eng_translit_title`=".$this->category." ";
            $conjunction =" AND";
        }

        if(isset($manufacturer)){
            if(!isset($conjunction)) { $conjunction = " WHERE ";} else {$conjunction = " AND "; }
            $name= $this->conn->quote($manufacturer);

            $this->manufacturer = $conjunction."`m`.`eng_translit_title`=".$name." ";
        }




        $sql="SELECT `p`.`id` AS product_id , `p`.`author`, `p`.`title` as product_title , `p`.`description`, `p`.`body`,
              `p`.`price`, `p`.`manf_id`, GROUP_CONCAT( DISTINCT `c`.`title` SEPARATOR ', ') AS `category_title` , 
               `m`.`id` as manufacturer_id , `m`.`title` AS manufacturer_title , GROUP_CONCAT(`im`.`image`) AS `images`
               FROM `products` `p`  LEFT JOIN `manufacturers` `m`  ON `p`.`manf_id` = `m`.`id`
                LEFT JOIN `images` `im` ON `p`.`id`= `im`.`product_id`
                JOIN `products_categories` `pivot` ON `p`.`id` = `pivot`.`product_id` JOIN `categories` `c` ON `pivot`.`category_id` = `c`.`id`
                $this->category $this->manufacturer GROUP BY `p`.`id` $this->order LIMIT ?, $this->amount  " ;



        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $startPage, \PDO::PARAM_INT);
        $stmt->execute();

        $result= $stmt->fetchAll();

//добавляем порядковый номер товарыв для вывода таблиць // и розюыраемось з изображениямы
        foreach ($result as $key=> $value){
            $startingLineNumber =(!isset($startingLineNumber))? ($this->page-1)*$this->amount+1: $startingLineNumber+1;
            $result[$key]->startingLineNumber= $startingLineNumber;

            if(!empty($value->images) && $value->images!= false ){

                $images= explode(',', $value->images);

                $result[$key]->images= array_values($images);

            }
        }

        return $result;
    }


    public function manufacturer()
    {
        return $this->hasOne('App\Manufacturer', 'manufacturer_id');
    }

    public function image(){

        return $this->hasMany('App\Image');
    }

    public function category()
    {
        return $this->hasMany('App\Category');
    }
}
