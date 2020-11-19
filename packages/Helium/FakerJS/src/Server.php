<?php

namespace Helium\FakerJS;

class Server{


    private static $compatible = false;
    private static $proc = null;
    public static $running = false;
    public static $url = '.';
    public static $port = '.'; 

    private static function testServer(){
        return file_get_contents(static::URL()."/test") === 'OK';
    }

    public static function URL(){
        return static::$url.":".static::$port;
    }

    /**
     * @return Server|null
     */
    static function checkRequiremnt()
    {
        $value = -1;
        $arr = array();
        exec('command -v pkill > /dev/null || echo "FakerServer requires pkill"',$arr, $value);
        static::$compatible = $value === 0;
        if(static::$compatible){
            static::$url = env('FAKER_SERVER');
            static::$port = env('FAKER_SERVER_PORT');
        }
        return static::$compatible;
    }
    
    static function start(){
        if(static::$compatible){
            $server_cmd = 'node .faker-server.js';
            $pipes = [];
            static::$proc = proc_open($server_cmd, array(
                0 => array('pipe', 'r'),
                1 => array('file', '/dev/tty', 'w'), //output to terminal
                2 => array('file', '/dev/tty', 'w')  //output errors to terminal
            ), $pipes);
            sleep(2); //wait for server to turn on
            static::$running = static::testServer();
            if(static::$running){
                error_log('Faker server is running');
            }
        }
    }

    /**
     * proc_open() will create new shell process and excute the given command inside it
     * when process is termanted by proc_terminate()
     * it will send signal 15 (TERM) to the shell
     * shell will terminate and leave node (child process) running
     * option -P to pkill will terminate all process matching the given parent ID
     * @return true|false
     */
    static function close()
    {
        if (static::$running){
            $pkill_result = -1;
            $arr = array();
            $proc_status = proc_get_status(static::$proc);
            exec('pkill -P '.$proc_status['pid'], $arr, $pkill_result);
            if($pkill_result !== 0){
                error_log("Faker server failed to turn off please turn it off manually");
                return false;
            }
            static::$running = false;
            return true;
        }
        return false;
    }
}