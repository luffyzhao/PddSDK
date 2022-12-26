<?php

namespace LPddSDK;

use Curl\Curl;
use Exception;
use GuzzleHttp\Client as GuzzleHttp;
use GuzzleHttp\Exception\InvalidArgumentException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use LPddSDK\Exception\ResponseException;
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
     * @var Curl
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

        $this->guzzle = new Curl();;
        $this->guzzle->setDefaultJsonDecoder($assoc = true);
        $this->guzzle->setHeader('Content-Type', 'application/json');
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
     * @param $type
     * @return $this
     */
    public function setDataType($type): self
    {
        $this->data['data_type'] = $type;
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
     * @return null
     * @throws Exception
     */
    private function post($query)
    {
        $this->guzzle->post($this->getUri('/api/router'), $query);

        if($this->guzzle->error) {
            throw new \HttpException($this->guzzle->errorMessage);
        }

        return $this->guzzle->response;
    }

    /**
     * @param $uri
     * @return string
     */
    private function getUri($uri)
    {
        return $this->baseUri . $uri;
    }

    /**
     * @param $response
     * @return mixed
     */
    private function response($response)
    {
        return $response;
    }
}
