<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$databaseArray = array(
    
  'Jiantang'=>array('dbname'=>'weixin_jiantang','host'=>'127.0.0.1','password'=>'123456','username'=>'root'),
    
  'Inhouse'=>array('dbname'=>'weixin_inhouse','host'=>'127.0.0.1','password'=>'123456','username'=>'root'),
    
);



$_ENV['database'] = $databaseArray;

?>

