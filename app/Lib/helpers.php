<?php

function generatePhoneNo($size){
   $prefix=["70","75","77","78"];
   for($i=0;$i<sizeof($prefix);$i++){
      $key = array_rand($prefix);
      $identifier = $prefix[$key];
      $randNo = "";
      for($j=0;$j<$size;$j++){
         $randNo .= rand(0,9);
      }
      $identifier .= $randNo;
   }

   return $identifier;
}