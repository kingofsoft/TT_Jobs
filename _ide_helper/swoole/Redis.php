<?php
namespace Swoole;
/**
 * 异步Redis客户端
 */
class Redis
{
    /**
     * 注册事件回调函数
     * @param $event_name
     * @param callable $callback
     */
    function on($event_name, callable $callback)
    {

    }

    /**
     * 连接到服务器
     * @param string $host
     * @param int $port
     * @param callable $callback
     */
    function connect($host, $port, callback $callback)
    {
    }


    /**
     * 关闭连接
     */
    function close()
    {
    }

    /**
     * 获取KEY值
     * @param $key
     * @param callable $callback
     */
    public function get($key, callback $callback)
    {
    }

    /**
     * 将当前值设置为指定的数字
     * @param $key
     * @param $value
     * @param callable $callback
     */
    public function set($key, $value, callback $callback)
    {
    }
}