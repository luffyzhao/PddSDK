<?php

namespace LPddSDK\Responses;

use LPddSDK\Responses;

class OrderNumberListIncrementGet
{
    /**
     * @var Responses
     * @author luffyzhao@vip.126.com
     */
    private $response;

    /**
     * OrderNumberListIncrementGet constructor.
     * @param Responses $response
     * @author luffyzhao@vip.126.com
     */
    public function __construct(Responses $response)
    {
        $this->response = $response;
    }

    /**
     * @return bool
     * @author luffyzhao@vip.126.com
     */
    public function isSuccess()
    {
        return $this->response->isStatusCodeSuccess() && isset($this->toArray()['order_sn_increment_get_response']);
    }

    /**
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function toArray()
    {
        return $this->response->toArray();
    }

    /**
     * @return int
     * @author luffyzhao@vip.126.com
     */
    public function getTotalCount(): int
    {
        return $this->toArray()['order_sn_increment_get_response']['total_count'];
    }

    /**
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function getList(): array
    {
        return $this->toArray()['order_sn_increment_get_response'];
    }
}