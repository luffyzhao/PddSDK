<?php
namespace LPddSDK\Signer;

use Illuminate\Support\Facades\Log;

class Md5
{
    /**
     * @var array
     * @author luffyzhao@vip.126.com
     */
    private $data;

    /**
     * Md5 constructor.
     * @param array $data
     * @author luffyzhao@vip.126.com
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function handel()
    {
        $singArr = $this->data;
        unset($singArr['client_secret']);
        unset($singArr['sign']);
        if(isset($singArr['access_token']) && empty($singArr['access_token'])){
            unset($singArr['access_token']);
        }
        $singArr['timestamp'] = (string)time();
        $singArr['sign'] = $this->sing($singArr);
        return $singArr;
    }

    /**
     * @param $singArr
     * @return string
     * @author luffyzhao@vip.126.com
     */
    private function sing($singArr)
    {
        ksort($singArr);
        $str = '';
        foreach ($singArr as $k => $v) {
            $str .= "{$k}{$v}";
        }
        return strtoupper(md5($this->data['client_secret'] . $str . $this->data['client_secret']));
    }
}
