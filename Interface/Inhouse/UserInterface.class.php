<?php

interface inhouseuser {

	/**
	 * 用户注册  v1
	 */
	public function sql_connect();

	/**
	 * 用户积分 累加  v1
	 */

	public function get_info();

	/**
	 * 判断用户是否已经注册
	 */

	public function cardApi();


	public function binding();


}

?>