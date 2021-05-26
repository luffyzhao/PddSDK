<?php
namespace LPddSDK\Signer;

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
        unset($singArr['sing']);

        $singArr['sing'] = $this->sing($singArr);

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
