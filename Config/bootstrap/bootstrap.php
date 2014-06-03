<?php

class website {

    public function __construct() {

        session_start();
        
        
        /**
         * 初始化 加载配置文件
         */
        include_once 'defined.php';
        
        /**
         * 初始化 加载配置文件
         */
        include_once 'database.php';
        /**
         * 引入扩展函数库
         */
        include_once 'extends.php';
        /**
         * 载入 路由 规则
         */
        include_once 'Dispatcher.class.php';
    }

    public function run() {
        /**
         * 加载Model以及DB层
         */
        $file_path = array('Config' => array('DB'),'Plug');

        foreach ($file_path as $fileKey => $fileValue) {

            include_path_file($fileValue, $fileKey);
        }
        
      
    
        /**
         * 处理URL 以及 执行Action
         */
        if (Develop == 1) {

            $this->initializationTest();
        } else {

            $this->initialization();
        }
    }

    private function initializationTest() {

        /**
         * 路由处理
         */
        $url = new Dispatcher();
        
        
        
 
        /**
         * 载入主目录的interface
         */
        include_path_file(array('interface' => 'Main'), 'Interface');
        
         /**
         * 载入主目录的C层类
         */
        include_path_file('Controllers', 'Controllers');
        
        /**
         * 载入该目录的interface
         */
        include_path_file(array('interface' => SOURCE), 'Interface');
        
        
        /**
         * 载入主目录的model
         */
        include_path_file(array('model' => 'Main'), 'Model');
        
        /**
         * 载入该来源的model
         */
        include_path_file(array('model' => SOURCE), 'Model');
        
        
        /**
         * 配置数据库信息
         */
        
        $this->setDatabase();
        
      
        $logs = apiLog . date("Y_m_d") . '.log';

        log_write(json_encode($_REQUEST), $logs, 'COME');
        
        R(MODULE_URL, MODULE_DIR_NAME);
    }
    
    
    private function setDatabase(){
        
        if(!empty($_ENV['database'])){
            
            $databaseInfo = $_ENV['database'][SOURCE];
            
            if(!empty($databaseInfo)){
                  
                defined('DBNAME') or define('DBNAME', $databaseInfo['dbname']);

                defined('USER') or define('USER', $databaseInfo['username']);

                defined('PASSWORD') or define('PASSWORD', $databaseInfo['password']);

                defined('DBHOST') or define('DBHOST',$databaseInfo['host']);
              
            } else{
                
                echoErrorCode(106);
            }
           
        }
        
    }

    private function initialization() {
        /**
         * 路由处理
         */
        $url = new Dispatcher();

        $url->dispatcher();

        if (!empty($_REQUEST['version'])) {

            $version = $_REQUEST['version'];


            $versionApi = include_once 'core.php';

            $api = $versionApi[$version];




            if (!empty($api[MODULE]) && is_array($api[MODULE])) {

                if (class_exists(MODULE_NAME_CONTROLLER)) {
                    /**
                     * 实例化类
                     */
                    $className = MODULE_NAME_CONTROLLER;

                    $module = new $className();

                    if ($module) {

                        /**
                         *  判断方法是否存在 如存在 执行方法
                         */
                        if (in_array(ACTION_NAME, $api[MODULE])) {
                            
                            $logs = apiLog . date("Y_m_d") . '.log';
                            log_write(json_encode($_REQUEST), $logs, 'COME');
                            call_user_func(array(&$module, ACTION_NAME));
                        } else {

                            echoErrorCode(101);
                        }
                    } else {

                        echoErrorCode(102);
                    }
                }
            } else {

                echoErrorCode(103);
            }
        }
    }

    public function request() {
        if (count($_REQUEST)) {
            
        }
    }

}

?>
