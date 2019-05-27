<?php declare(strict_types = 1);

namespace Omnipay\WsPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\WsPay\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{


    public function getName()
    {
        return 'WsPay';
    }

    public function getDefaultParameters()
    {
        return array(
            'ShopID' => '',
            'SecretKey' => '',
            'testMode' => true,
        );
    }

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

	public function getReturnUrl()
	{
		return $this->getParameter('ReturnURL');
	}

	public function setReturnUrl(string $value)
	{
		return $this->setParameter('ReturnURL', $value);
	}

	public function setReturnErrorURL(string  $value)
	{
		return $this->setParameter('ReturnErrorURL', $value);
	}

	public function setCancelURL(string  $value)
	{
		return $this->setParameter('CancelURL', $value);
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

	public function setSignature(string $shopId, string $secretKey, string $shoppingCartId, string $amount)
	{
		$formatedAmount = $this->getFormatedPrice($amount);
		$signature = md5($shopId . $secretKey . $shoppingCartId . $secretKey . $formatedAmount . $secretKey);

		return $this->setParameter('Signature', $signature);
	}

	public function getTotalAmount()
	{
		return $this->getParameter('TotalAmount');
	}

	public function setTotalAmount(string $value)
	{
		return $this->setParameter('TotalAmount', $value);
	}

	public function purchase(array $parameters = array())
	{
		return $this->createRequest(PurchaseRequest::class, $parameters);
	}

	private function getFormatedPrice(string $amount)
	{
		return str_replace(",", "", $amount);
	}

}
