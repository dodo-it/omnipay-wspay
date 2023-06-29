<?php declare(strict_types = 1);

namespace Omnipay\WsPay\Message;

use Omnipay\Common\Message\ResponseInterface;

class StatusCheckRequest extends AbstractRequest
{

    protected $liveEndpoint = 'https://secure.wspay.biz/api/services/statusCheck';

    protected $testEndpoint = 'https://test.wspay.biz/api/services/statusCheck';

    public function getData(): array
    {
        $data = array();
        $data['ShopID'] = $this->getShopId();
        $data['ShoppingCartID'] = $this->getShoppingCartId();
        $data['Signature'] = $this->getSignature();
        $data['Version'] = '2.0';
        return $data;
    }

    public function sendData($data): ResponseInterface
    {
        $url = $this->getEndpoint();
        $response = $this->httpClient->request(
            'post',
            $url,
            ['Content-Type' => 'application/json'],
            json_encode($data)
        );
        $data = json_decode($response->getBody()->getContents(), true);

        return $this->response = new StatusCheckResponse($this, $data);
    }

}
