<?php

class ExchangeController extends MainExchangeController implements jiantangexchange {


    public function __construct() {

        /**
         *  判断来源   根据来源来加载扩展库 如一般接口中不存在 相应的接口  查找扩展库中是否存在
         *  如存在 就执行扩展库中的方法
         */

        if(!empty($_REQUEST['source'])){

            $source = $_REQUEST['source'].'.php';

            if(file_exists(PLUGDIR.$source)){

                $name = $_REQUEST['source'].'Plug';

                $object = new $name();

                if(!method_exists($this,ACTION_NAME)){

                    if(method_exists($object, ACTION_NAME)){


                        call_user_func(array($object, ACTION_NAME),$_REQUEST);  

                        die;

                    }
                   
                }
            }
            
        }
    }
    

    

}

?>