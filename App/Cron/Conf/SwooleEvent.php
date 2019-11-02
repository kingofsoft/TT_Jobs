<?php
/**
 * Created by PhpStorm.
 * User: yangcai
 * Date: 2018/5/24
 * Time: 17:53
 */

namespace Cron\Conf;

use Core\Conf\Config;
use Core\Http\Request;
use Core\Http\Response;
use Core\AbstractInterface\AEvent;
use Common\Cron\Tasks as CronTasks;
use Common\Cron\TasksLoad as CronLoadTasks;
use Common\Cron\Dispatcher as CronDispatcher;
use Common\Cron\ProcessManager as CronProcessManager;
use Cron\Event\onHttpDispatcher;
use think\Db;
use think\db\Query;

/**
 * Class SwooleEvent
 *
 * @package Conf
 */
class SwooleEvent extends AEvent
{
    function frameInitialize()
    {
        if (
            version_compare(phpversion('swoole'), '4.2.9', '>')
            and !extension_loaded('swoole_async')
        ) {
            exit('请安装 swoole async 模块 或降级 swoole 至 4.2.9 及以下版本');
        }
    }

    function frameInitialized()
    {
//        (new Query)->listen(function ($sql, $time, $explain, $master) {
//            echo '[' . date('Y-m-d H:i:s') . '] ' . $sql . ' [' . $time . 's] ' . ($master ? 'master' : 'slave') . PHP_EOL;
////            var_dump($explain);
//        });
    }

    function beforeWorkerStart(\swoole_server $server)
    {
        CronTasks::getInstance();
        CronLoadTasks::getInstance();
        CronProcessManager::getInstance();
    }

    function onStart(\swoole_server $server)
    {
    }

    function onShutdown(\swoole_server $server)
    {
    }

    function onWorkerStart(\swoole_server $server, $workerId)
    {
        CronDispatcher::getInstance()->setServer($server, $workerId)->dispatch();
    }

    function onWorkerStop(\swoole_server $server, $workerId)
    {
    }

    function onRequest(Request $request, Response $response)
    {
    }

    function onDispatcher(Request $request, Response $response, $targetControllerClass, $targetAction)
    {
        onHttpDispatcher::auth($request, $response, $targetControllerClass, $targetAction);
        onHttpDispatcher::accessLog($request, $response, $targetControllerClass, $targetAction);
    }

    function onResponse(Request $request, Response $response)
    {
    }

    function onTask(\swoole_server $server, $taskId, $workerId, $taskObj)
    {
    }

    function onFinish(\swoole_server $server, $taskId, $taskObj)
    {
    }

    function onWorkerError(\swoole_server $server, $workerId, $workerPid, $exitCode)
    {
    }

    function onMessage(\swoole_server $server, $frame)
    {
    }
}
