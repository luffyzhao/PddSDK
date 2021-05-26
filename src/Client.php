<?php

namespace LPddSDK;

use Exception;
use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    private $baseUri = 'https://gw-api.pinduoduo.com';

    /**
     * @var float
     * @author luffyzhao@vip.126.com
     */
    private $timeout = 30;

    /**
     * @var array
     * @author luffyzhao@vip.126.com
     */
    private $data = [
        'client_id' => '',
        'client_secret' => '',
        'access_token' => '',
        'data_type' => 'JSON',
        'type' => ''
    ];
    /**
     * @var GuzzleHttp
     * @author luffyzhao@vip.126.com
     */
    private $guzzle;

    /**
     * Client constructor.
     * @param $clientId
     * @param $clientSecret
     * @author luffyzhao@vip.126.com
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->data['client_id'] = $clientId;
        $this->data['client_secret'] = $clientSecret;

        $this->guzzle = new GuzzleHttp([
            'base_uri' => $this->baseUri,
            'timeout' => $this->timeout,
        ]);
    }

    /**
     * @param $accessToken
     * @return Client
     * @author luffyzhao@vip.126.com
     */
    public function setAccessToken($accessToken): self
    {
        $this->data['access_token'] = $accessToken;
        return $this;
    }

    /**
     * @param $type
     * @return Client
     * @author luffyzhao@vip.126.com
     */
    public function setType($type): self
    {
        $this->data['type'] = $type;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return Client
     * @author luffyzhao@vip.126.com
     */
    public function setAttribute($key, $value): self
    {
        if (!array_key_exists($key, $this->data)) {
            $this->data[$key] = $value;
        }
        return $this;
    }

    /**
     * @return array|bool|float|int|object|string|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     * @author luffyzhao@vip.126.com
     */
    public function handle()
    {
        $signer = new Signer\Md5($this->data);
        $data = $signer->handel();
        return $this->response(
            $this->post($data)
        );
    }

    /**
     * @param $query
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author luffyzhao@vip.126.com
     */
    private function post($query)
    {
        foreach ($query as &$v){
            if (is_array($v)) {
                $v = json_encode($v);
            } else if ($v === true) {
                $v = 'true';
            } else if ($v === false) {
                $v = 'false';
            }
        }
        return $this->guzzle->request("POST",'/api/router', [
            'form_params' => $query,
            'curl' => [
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            ]
        ]);
    }

    /**
     * @param ResponseInterface $response
     * @return array|bool|float|int|object|string|null
     * @throws Exception
     * @author luffyzhao@vip.126.com
     */
    private function response(ResponseInterface $response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new Exception(sprintf("接口请求返回StatusCode不正确[%d]", $response->getStatusCode()));
        }
        try {
            $body = \GuzzleHttp\json_decode(
                $response->getBody()->getContents(),
                true
            );

            if (isset($body['error_response'])) {
                throw new Exception(sprintf('接口异常:%s', \GuzzleHttp\json_encode($body['error_response'])));
            }

            return $body;
        } catch (InvalidArgumentException $exception) {
            throw new Exception(sprintf("参数解析失败: %s", $response->getBody()->getContents()));
        }

    }
}
