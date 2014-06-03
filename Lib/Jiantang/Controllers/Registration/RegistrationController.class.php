<?php

class RegistrationController  extends MainRegistrationController implements jiantangregistration {


   /**
     *  签到增加1积分
     */
    public function userRegisterationIntegration() {

        if (!empty($_REQUEST['open_id']) && !empty($_REQUEST['source'])) {

            $user = new userModel();

            $userInfo = $user->getUserInfo($_REQUEST['open_id']);

            $addIntegration = $user->addUserIntegration($_REQUEST['open_id'], 1);

            /**
             * 脊安堂 
             */
            if (count($userInfo) > 0) {

                $user_registeration = new UserRegistrationModel();

                $user_registeration->getUserRegisteration($userInfo);
            }
        } else {

            echoErrorCode(105);
        }
    }

}

?>