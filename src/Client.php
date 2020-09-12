<?php
namespace LPddSDK;

use LPddSDK\Parameters\Common;
use LPddSDK\Tools\Sign;
use GuzzleHttp\Client as GuzzleHttp;

class Client
{
    /**
     * @var Common
     * @author luffyzhao@vip.126.com
     */
    private $common;

    private $guzzleHttp;

    /**
     * Client constructor.
     * @param Common $common
     * @author luffyzhao@vip.126.com
     */
    public function __construct(Common $common)
    {
        $this->common = $common;

        $this->guzzleHttp = new GuzzleHttp([
            'base_uri' => 'http://gw-api.pinduoduo.com',
            'timeout'  => 2.0,
        ]);
    }

    /**
     * @return Common
     * @author luffyzhao@vip.126.com
     */
    public function getCommon(): Common
    {
        return $this->common;
    }

    /**
     * @param array $data
     * @return Responses
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author luffyzhao@vip.126.com
     */
    public function handle(array $data){
        $query = $this->splicing($data);
        return new Responses($this->guzzleHttp->post('/api/router', [
            'form_params' => $query
        ]));
    }

    /**
     * @param array $data
     * @return array
     * @author luffyzhao@vip.126.com
     */
    protected function splicing(array $data){
        $query = $data + $this->common->toArray();
        $sign = new Sign($this->common->getClientSecret());
        $query['sign'] = $sign->handle($query);
        return $query;
    }

}