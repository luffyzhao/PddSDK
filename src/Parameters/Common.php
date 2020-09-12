<?php
namespace LPddSDK\Parameters;

class Common
{
    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $type;

    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $clientId;

    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $accessToken;

    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $clientSecret;

    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $timestamp;

    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $dataType = "JSON";

    /**
     * @var string
     * @author luffyzhao@vip.126.com
     */
    protected $version = 'V1';

    /**
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @author luffyzhao@vip.126.com
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @author luffyzhao@vip.126.com
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     * @author luffyzhao@vip.126.com
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @author luffyzhao@vip.126.com
     */
    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @author luffyzhao@vip.126.com
     */
    public function setTimestamp(string $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getDataType(): string
    {
        return $this->dataType;
    }

    /**
     * @param string $dataType
     * @author luffyzhao@vip.126.com
     */
    public function setDataType(string $dataType): void
    {
        $this->dataType = $dataType;
    }

    /**
     * @return string
     * @author luffyzhao@vip.126.com
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @author luffyzhao@vip.126.com
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function toArray(){
        return [
            'type' => $this->type,
            'client_id' => $this->clientId,
            'access_token' => $this->accessToken,
            'timestamp' => time(),
            'data_type' => $this->dataType,
            'version' => $this->version,
        ];
    }
}