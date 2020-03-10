<?php
namespace app\grab\services;

class Http
{
    public function curlRequest($url, $data=[], $header=[], $ignoreSsl=0, $timeout=30, $forcePost=0){
        $curl = curl_init();
        // request url
        curl_setopt($curl, CURLOPT_URL, $url);
        // headers
        if(!empty($header)) curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // post fields
        if (!empty($data) || !empty($forcePost)) { // post方式
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        // https
        if (!empty($ignoreSsl)) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        // timeout
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

        $output = curl_exec($curl);
        if (curl_error($curl) || !$output) {
            $output = curl_error($curl);
            print_r($output);
            curl_close($curl);
            return false;
        }
        curl_close($curl);
        return $output;

        // $output = curl_exec($curl);
        // if (curl_error($curl)) $output = curl_error($curl);
        // curl_close($curl);
        // return $output;
    }

    /**
     * curl下载文件
     * @param string $url 下载文件地址
     * @param string $saveFlder 下载文件保存目录
     * @param string $filename 下载文件保存名称
     * @return bool
     */
    public function curlLoadFile($url, $saveFlder, $ext, $tryTimes=5)
    {
        $i = 0;
        while ($i < $tryTimes) {
            // curl 获取文件内容
            $content = $this->curlRequest($url, '', '', 1);
            $filename = md5(mt_rand() . time() . uniqid('curl_load_file', true)) . $ext;
            $savePath = $saveFlder . $filename;
            // 保存文件到制定路径
            $putRes = file_put_contents($savePath, $content);
            if (!$putRes && !$content) $i++;
            else return $savePath;
        }
        return false;
    }

    /**
     * [saveUrlToLocal 下载文件到本地]
     * @Author   liqiang2@yy.com
     * @DateTime 2019-11-13T16:46:26+0800
     * @param    [type]                   $url          [description]
     * @param    [type]                   $filename     [文件名]
     * @param    integer                  $forceRewrite [是否覆盖本地已存在相同文件名的文件]
     * @param    integer                  $tryTimes     [重试次所]
     * @return   [type]                                 [description]
     */
    public function saveUrlToLocal($url, $filename = '', $forceRewrite = 0, $tryTimes = 5)
    {
        if (!$url) {
            return false;
        }
        if (!$filename) {
            $filename = md5($url);
        }
        if (!is_dir(dirname($filename))) {
            mkdir(dirname($filename),0777,true);
        }
        $i = 0;
        $timeout = 30;
        while ($i < $tryTimes) {

            if (file_exists($filename) && filesize($filename) > 0 && !$forceRewrite) {
                return $filename;
            }

            $header = [
                'Accept-Encoding: gzip',
                'Host: '.parse_url($url)['host'],
            ];

            $file = $this->curlRequest($url, '', $header, 1,$timeout += 10);
            if ($file) {
                if (file_put_contents($filename, $file)) return $filename;
                $i++;
                continue;
            }
            $i++;
        }
        return false;
    }

    public function curlMultiReq($urls, $setWaitUsec=0)
    {
        $handle=[];
        $running = 0;
        $waitUsec = intval($setWaitUsec);
        $mh = curl_multi_init();
        foreach($urls as $key => $url) {
            $ch = $this->genCurlHandle($url);
            curl_multi_add_handle($mh, $ch);
            $handle[$key] = $ch;
        }
        /* 执行 */
        do {
            curl_multi_exec($mh, $running);
            if ($waitUsec > 0) /* 每个 connect 要间隔多久 */
                usleep($waitUsec); // 250000 = 0.25 sec
        } while ($running > 0);
        $response = [];
        foreach($handle as $i => $ch) {
            $response[] = curl_multi_getcontent($ch);
            curl_multi_remove_handle($mh, $ch);
        }
        curl_multi_close($mh);
        return $response;
    }

    public function genCurlHandle($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 6.4.4; zh-CN; Che1-CL10 Build/Che1-CL10) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/10.10.0.800 U3/0.8.0 Mobile Safari/534.30');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 302 redirect
        curl_setopt($ch, CURLOPT_MAXREDIRS, 7);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        return $ch;
    }
}