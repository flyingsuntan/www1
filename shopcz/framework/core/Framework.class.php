<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/25
 * Time: 15:08
 */
//核心启动类
class Framework{
    //定义一个run方法
    public  static  function run(){
        //echo "hello word!";
        self::init();
        self::autoload();
        self::dispatch();

    }
    //初始化方法
    private  static  function  init(){
        //定义路径常量
        define("DS",DIRECTORY_SEPARATOR);
        define("ROOT",getcwd() . DS);//根目录
        define("APP_PATH",ROOT . 'application' . DS);
        define("FRAMEWORK_PATH" , ROOT . 'framework' . DS);
        define("PUBLIC_PATH" , ROOT . "public" . DS );
        define("CONFIG_PATH",APP_PATH . 'config' . DS);
        define("CONTROLLER_PATH" , APP_PATH . 'controllers' . DS);
        define("MODEL_PATH" , APP_PATH . 'models' . DS);
        define("VIEW_PATH" , APP_PATH . 'views' . DS);
        define("CORE_PATH" , FRAMEWORK_PATH . 'core' . DS);
        define("DB_PATH" , FRAMEWORK_PATH . 'databases' . DS);
        define("LIB_PATH" , FRAMEWORK_PATH . 'libraries' . DS);
        define("HELPER_PATH" , FRAMEWORK_PATH . 'helpers' . DS);
        define("UPLOAD_PATH" , PUBLIC_PATH . 'uploads' . DS);

        //获取参数p、c、a, index.php?p=admin&c=goods&a=add
        define("PLATFORM" , isset($_GET['p']) ? $_GET['p'] : "home");
        define("CONTROLLER" , isset($_GET['c']) ? ucfirst($_GET['c']) : "index");
        define("ACTION" , isset($_GET['a']) ? $_GET['a'] : "index");
        define("CUR_CONTROLLER_PATH" , CONTROLLER_PATH . PLATFORM . DS );
        define("CUR_VIEW_PATH" , VIEW_PATH . PLATFORM . DS );

        //载入配置文件
        $GLOBALS['config'] = include CONFIG_PATH . "config.php";


        //载入核心类
        include CORE_PATH . "Controller.class.php";
        include CORE_PATH . "Model.class.php";
        include DB_PATH . "Mysql.class.php";

        //开启session
        session_start();



    }
    //路由方法 ,就是实例化对象并调用方法
    //index.php?p=admin&c=goods&a=add
    private static function dispatch(){
        //获取控制器名称
        $controller_name = CONTROLLER . "Controller";
        //获取方法名称
        $action_name = ACTION . "Action";
        //实例化控制器对象
        $controller = new $controller_name;
        //调用方法
        $controller->$action_name();
    }
    //自动加载
    private static function autoload(){
        //$arr = array(__CLASS__,'load');
       // spl_autoload_register($arr);
        spl_autoload_register('self::load');
    }

    //自动加载，此处我们只实现控制器和数据库模型的自动加载
    //如GoodsController GoodsModel
    private  static function load($classname){
        if(substr($classname,-10) == 'Controller'){
            //载入控制器
            include  CUR_CONTROLLER_PATH . $classname . ".class.php";
        }else if(substr($classname,-5) == 'Model'){
            include  MODEL_PATH . $classname . ".class.php";
        }else{
            //暂略
        }
    }
}