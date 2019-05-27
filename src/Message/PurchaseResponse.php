<?php declare(strict_types = 1);

namespace Omnipay\WsPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

	protected $endpoint = 'https://form.wspay.biz/Authorization.aspx';

	protected $testEndpoint = 'https://formtest.wspay.biz/Authorization.aspx';

	public function isSuccessful()
	{
		return false;
	}

	public function isRedirect()
	{
		return true;
	}

	public function getRedirectUrl()
	{
		return $this->getRequest()->getTestMode() ? $this->testEndpoint : $this->endpoint;
	}

	public function getRedirectMethod()
	{
		return 'POST';
	}

	public function getRedirectData()
	{
		return $this->data;
	}

}