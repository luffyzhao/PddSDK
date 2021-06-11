<?php
namespace LPddSDK\Exception;

use Psr\Http\Message\StreamInterface;

class ResponseException extends \Exception
{
    /**
     * @var StreamInterface
     * @author luffyzhao@vip.126.com
     */
    private $response;

    /**
     * ResponseException constructor.
     * @param string $message
     * @param StreamInterface $response
     * @param int $code
     * @param Throwable|null $previous
     * @author luffyzhao@vip.126.com
     */
    public function __construct(StreamInterface $response, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return StreamInterface
     * @author luffyzhao@vip.126.com
     */
    public function getResponse(): StreamInterface
    {
        return $this->response;
    }
}
