<?php declare(strict_types = 1);

namespace Omnipay\WsPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\MessageInterface;

class StatusCheckResponse extends AbstractResponse implements MessageInterface
{


    public function isSuccessful(): bool
    {
        return false;
    }

}
