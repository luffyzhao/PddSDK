<?php


namespace LPddSDK;


use Psr\Http\Message\ResponseInterface;

class Responses
{
    /** @var ResponseInterface */
    private $response;

    /**
     * OrderNumberListIncrementGet constructor.
     * @param ResponseInterface $response
     * @author luffyzhao@vip.126.com
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    public function isStatusCodeSuccess()
    {
        return $this->response->getStatusCode() === 200;
    }

    /**
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function toArray(): array
    {
        try {
            return \GuzzleHttp\json_decode($this->response->getBody()->getContents(), true);
        } catch (\Exception $response) {
            var_dump($this->response->getBody()->getContents());
            return [];
        }
    }
}