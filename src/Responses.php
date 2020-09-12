<?php


namespace LPddSDK;


use Exception;
use GuzzleHttp\Exception\InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Throwable;

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
        $contents = (string)$this->response->getBody()->getContents();
        try {
            if(($data = json_decode($contents, true)) !== null){
                return $data;
            }
            return ['error_response' => ['error_msg' => 'json解析错误']];
        } catch (Exception | Throwable $exception) {
            return [
                'error_response' => [
                    'error_msg' => $exception->getMessage(),
                    'sub_msg' => $contents
                ]
            ];
        }
    }
}