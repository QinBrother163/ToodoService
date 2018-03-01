<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;


class GitEventController extends Controller
{
    public function onPush(Request $request)
    {
        //git webhook 自动部署脚本
        $requestBody = $request->getContent();
        if (empty($requestBody)) {
            return 'empty request!';
        }
        $content = json_decode($requestBody, true);

        $ref = $content['ref'];
        $repoName = $content['repository']['name'];
        $repoUrl = $content['repository']['url'];
        $tcc = $content['total_commits_count'];
        $user = $content['user_name'];

        //若是主分支且提交数大于0
        if ($ref == 'refs/heads/master' && $tcc > 0) {
            $res_log = '-------------------------' . PHP_EOL;
            $res_log .= $user . ' 在' . date('Y-m-d H:i:s') . '向' . $repoName . '项目的' . $ref . '分支push了' . $tcc . '个commit：' . PHP_EOL;

            $tdsrv = shell_exec("ls -l /toodo/tt_web/html/ | grep tdsrv | awk '{print $11}'");
            $len = strpos($tdsrv, 'ToodoService');
            $root = substr($tdsrv, 0, $len);

            $path = $root . $repoName; //项目存放物理路径

            if (is_dir($path)) {
                //shell_exec("cd {$path} && git start --hard origin/master && git clean -f && git pull 2>&1 && git checkout master");
                $res = shell_exec("cd {$path} && git rebase origin 2>&1 && git pull 2>&1");
                $res_log .= $res . PHP_EOL;

            } else {
                $res = shell_exec("cd {$root} && git clone {$repoUrl} 2>&1 && cd {$repoName} && git checkout master");
                $res_log .= $res . PHP_EOL;
                $res_log .= '项目还没有部署完成哦！没有软妹子到web服务器呢。' . PHP_EOL;
            }

            file_put_contents("git-webhook.txt", $res_log, FILE_APPEND);//追加写入
        }

        return response('git push event.');
    }

    public function onTest(Request $request)
    {
        $res_log = '-------------------------' . PHP_EOL;
        $res_log .= $request->getContent() . PHP_EOL;
        file_put_contents("git-test.txt", $res_log, FILE_APPEND);//追加写入
        Log::info($res_log);
        return response('git test event.');
    }
}
