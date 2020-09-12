<?php
namespace LPddSDK\Tools;

class Sign
{
    /**
     * @var string|string
     * @author luffyzhao@vip.126.com
     */
    private $clientSecret;

    /**
     * Sign constructor.
     * @param string $clientSecret
     * @author luffyzhao@vip.126.com
     */
    public function __construct(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return Sign
     * @author luffyzhao@vip.126.com
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @param array $data
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function handle(array $data){
        ksort($data);
        $str = '';
        foreach ($data as $k => $v) {
            $str .= "{$k}{$v}";
        }
        return strtoupper(md5($this->clientSecret . $str . $this->clientSecret));
    }
}