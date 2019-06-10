<?php

namespace Omnipay\WsPay\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * Abstract Request
 *
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    protected $liveEndpoint = 'https://form.wspay.biz/Authorization.aspx';

    protected $testEndpoint = 'https://formtest.wspay.biz/Authorization.aspx';

	public function getShopId()
	{
		return $this->getParameter('ShopID');
	}

	public function setShopId($value)
	{
		return $this->setParameter('ShopID', $value);
	}

	public function getSecretKey()
	{
		return $this->getParameter('SecretKey');
	}

	public function setSecretKey(string $value)
	{
		return $this->setParameter('SecretKey', $value);
	}

	public function getShoppingCartId()
	{
		return $this->getParameter('ShoppingCartID');
	}

	public function setShoppingCartId(string $value)
	{
		return $this->setParameter('ShoppingCartID', $value);
	}

	public function getSignature()
	{
		return $this->getParameter('Signature');
	}

	public function setSignature(string $value)
	{
		return $this->setParameter('Signature', $value);
	}

	public function getTotalAmount()
	{
		return $this->getParameter('TotalAmount');
	}

	public function setTotalAmount(string $value)
	{
		return $this->setParameter('TotalAmount', $value);
	}

	public function setReturnUrl($value)
	{
		return $this->setParameter('ReturnURL', $value);
	}

	public function getReturnUrl()
	{
		return $this->getParameter('ReturnURL');
	}


	public function setReturnErrorUrl($value)
	{
		return $this->setParameter('ReturnErrorURL', $value);
	}


	public function getReturnErrorURL()
	{
		return $this->getParameter('ReturnErrorURL');
	}

	public function setCancelUrl($value)
	{
		return $this->setParameter('CancelURL', $value);
	}

	public function getCancelUrl()
	{
		return $this->getParameter('CancelURL');
	}

	public function getLang()
	{
		return $this->getParameter('Lang');
	}

	public function setLang(string $value)
	{
		return $this->setParameter('Lang', $value);
	}

	public function getIntAmount()
	{
		return $this->getParameter('IntAmount');
	}

	public function setIntAmount(string $value)
	{
		return $this->setParameter('IntAmount', $value);
	}

	public function getIntCurrency()
	{
		return $this->getParameter('IntCurrency');
	}

	public function setIntCurrency(string $value)
	{
		return $this->setParameter('IntCurrency', $value);
	}

	public function setPaymentPlan(string $value)
	{
		return $this->setParameter('PaymentPlan', $value);
	}

	public function getPaymentPlan()
	{
		return $this->getParameter('PaymentPlan');
	}

    public function sendData($data)
    {
        $url = $this->getEndpoint().'?'.http_build_query($data, '', '&');
        $response = $this->httpClient->get($url);

        $data = json_decode($response->getResponseBody(), true);

        return $this->createResponse($data);
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
