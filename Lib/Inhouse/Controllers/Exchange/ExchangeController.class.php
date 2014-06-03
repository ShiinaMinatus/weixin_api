<?php

class ExchangeController extends MainExchangeController implements inhouseexchange {

   

    /**
     *   兑换  验证码
     */
    public function create() {

        if (!empty($_REQUEST['open_id']) && !empty($_REQUEST['exchange_id'])) {

            $user = new userModel();

            $userInfo = $user->getUserInfo($_REQUEST['open_id']);


            if (count($userInfo) > 0) {

                $result['user_id'] = $userInfo['user_id'];

                $result['exchange_id'] = $_REQUEST['exchange_id'];

                $exchange_code = new ExchangeCodeModel();

                $guoqishijian = time() - 600000;

                $array = $exchange_code->create($result);

                AssemblyJson($array);
            }
        }
    }

}

?>