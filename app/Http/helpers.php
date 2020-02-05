<?php
function getCategory($categories){
   $data = [];
   $select_data = array(
       'id' => "parent",
       'label' => "Parent Category",
   );
   $data[] = (object) $select_data;
  // echo"<pre>categories:";print_r($categories);exit;
   if(count($categories)){
   // $child = manageChild($categories->children);
     foreach($categories as $category){
        $child = manageChild($category->children);
           $data[] = array(
               'id' => $category->id,
               'label' => $category->name,
               'children' => $child,
           );
    }
   }
  // echo"<pre>data";print_r($data);exit;

   return $data;
}
function manageChild($childs){
   $data1 = [];
   if(count($childs)){
       foreach($childs as $child){
           $child1 = [];
           if(isset($child->children) && count($child->children)){
               $childn = [];
               foreach($child->children as $child2){
                   if(isset($child2->children) && count($child2->children)){
                       $childn = manageChild($child2->children);
                   }
                   $child1[] = array(
                       'id' => isset($child2->id) ? $child2->id : "",
                       'label' => isset($child2->name) ? $child2->name: "",
                       'children' => $childn
                   );
               }
           }
           $data1[] = array(
               'id' => $child->id,
               'label' => $child->name,
               'children' => $child1
           );
       }
   }
   return $data1;
}
  