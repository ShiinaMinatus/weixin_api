<?php

class OrderController extends MainOrderController implements jiantangorder {

  
    /**
     * 脊安堂 下订单  成功后 增加100积分
     */
    public function add() {

        //$_REQUEST['open_id'] = $this->open_id;

        if (!empty($_REQUEST['source'])) {

            if (!empty($_REQUEST['open_id']) && !empty($_REQUEST['merchandise_id'])) {

                if (!empty($_REQUEST['order_number']) && $_REQUEST['order_number'] > 0) {

                    if (!empty($_REQUEST['appointment_time'])) {

                        $user = new userModel();

                        $userInfo = $user->getUserInfo($_REQUEST['open_id']);

                        $orderModel = new OrderModel();

                        $orderInfo = $orderModel->getOrderInfo($userInfo['user_id'], 0);

                        if (count($orderInfo) > 0) {

                            echoErrorCode(30005);
                        } else {

                            /**
                             * 预约成功  脊安堂  增加100积分
                             */
                            $user->addUserIntegration($_REQUEST['open_id'], 100);

                            $orderInfo['order'] = $orderModel->crearteOrder($_REQUEST, $userInfo);

                            $orderInfo['user'] = arrayToObject($userInfo, 0);

                            AssemblyJson($orderInfo);
                        }
                    } else {

                        echoErrorCode(30002);
                    }
                } else {


                    echoErrorCode(30001);
                }
            } else {


                echoErrorCode(30006);
            }
        }
    }

}

?>