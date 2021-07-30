<?php

namespace Tests\Helpers;

use Helldar\CashierDriver\Tinkoff\QrCode\Helpers\Statuses;
use Tests\TestCase;

class StatusesTest extends TestCase
{
    public function testModel()
    {
        $this->assertTrue($this->statuses()->hasCreated());
        $this->assertTrue($this->statuses()->inProgress());

        $this->assertFalse($this->statuses()->hasSuccess());
        $this->assertFalse($this->statuses()->hasFailed());
        $this->assertFalse($this->statuses()->hasRefunding());
        $this->assertFalse($this->statuses()->hasRefunded());
    }

    public function testHasCreated()
    {
        $this->assertTrue($this->statuses()->hasCreated('FORM_SHOWED'));
        $this->assertTrue($this->statuses()->hasCreated('NEW'));

        $this->assertFalse($this->statuses()->hasCreated('AUTHORIZED'));
        $this->assertFalse($this->statuses()->hasCreated('AUTHORIZING'));
        $this->assertFalse($this->statuses()->hasCreated('CONFIRMING'));
        $this->assertFalse($this->statuses()->hasCreated('REFUNDING'));

        $this->assertFalse($this->statuses()->hasCreated('PARTIAL_REFUNDED'));
        $this->assertFalse($this->statuses()->hasCreated('REFUNDED'));
        $this->assertFalse($this->statuses()->hasCreated('REVERSED'));

        $this->assertFalse($this->statuses()->hasCreated('ATTEMPTS_EXPIRED'));
        $this->assertFalse($this->statuses()->hasCreated('CANCELED'));
        $this->assertFalse($this->statuses()->hasCreated('DEADLINE_EXPIRED'));
        $this->assertFalse($this->statuses()->hasCreated('REJECTED'));

        $this->assertFalse($this->statuses()->hasCreated('CONFIRMED'));

        $this->assertFalse($this->statuses()->hasCreated('UNKNOWN'));
    }

    public function testHasSuccess()
    {
        $this->assertFalse($this->statuses()->hasSuccess('FORM_SHOWED'));
        $this->assertFalse($this->statuses()->hasSuccess('NEW'));

        $this->assertFalse($this->statuses()->hasSuccess('AUTHORIZED'));
        $this->assertFalse($this->statuses()->hasSuccess('AUTHORIZING'));
        $this->assertFalse($this->statuses()->hasSuccess('CONFIRMING'));
        $this->assertFalse($this->statuses()->hasSuccess('REFUNDING'));

        $this->assertFalse($this->statuses()->hasSuccess('PARTIAL_REFUNDED'));
        $this->assertFalse($this->statuses()->hasSuccess('REFUNDED'));
        $this->assertFalse($this->statuses()->hasSuccess('REVERSED'));

        $this->assertFalse($this->statuses()->hasSuccess('ATTEMPTS_EXPIRED'));
        $this->assertFalse($this->statuses()->hasSuccess('CANCELED'));
        $this->assertFalse($this->statuses()->hasSuccess('DEADLINE_EXPIRED'));
        $this->assertFalse($this->statuses()->hasSuccess('REJECTED'));

        $this->assertTrue($this->statuses()->hasSuccess('CONFIRMED'));

        $this->assertFalse($this->statuses()->hasSuccess('UNKNOWN'));
    }

    public function testHasFailed()
    {
        $this->assertFalse($this->statuses()->hasFailed('FORM_SHOWED'));
        $this->assertFalse($this->statuses()->hasFailed('NEW'));

        $this->assertFalse($this->statuses()->hasFailed('AUTHORIZED'));
        $this->assertFalse($this->statuses()->hasFailed('AUTHORIZING'));
        $this->assertFalse($this->statuses()->hasFailed('CONFIRMING'));
        $this->assertFalse($this->statuses()->hasFailed('REFUNDING'));

        $this->assertFalse($this->statuses()->hasFailed('PARTIAL_REFUNDED'));
        $this->assertFalse($this->statuses()->hasFailed('REFUNDED'));
        $this->assertFalse($this->statuses()->hasFailed('REVERSED'));

        $this->assertTrue($this->statuses()->hasFailed('ATTEMPTS_EXPIRED'));
        $this->assertTrue($this->statuses()->hasFailed('CANCELED'));
        $this->assertTrue($this->statuses()->hasFailed('DEADLINE_EXPIRED'));
        $this->assertTrue($this->statuses()->hasFailed('REJECTED'));

        $this->assertFalse($this->statuses()->hasFailed('CONFIRMED'));

        $this->assertFalse($this->statuses()->hasFailed('UNKNOWN'));
    }

    public function testHasRefunding()
    {
        $this->assertFalse($this->statuses()->hasRefunding('FORM_SHOWED'));
        $this->assertFalse($this->statuses()->hasRefunding('NEW'));

        $this->assertTrue($this->statuses()->hasRefunding('AUTHORIZED'));
        $this->assertTrue($this->statuses()->hasRefunding('AUTHORIZING'));
        $this->assertTrue($this->statuses()->hasRefunding('CONFIRMING'));
        $this->assertTrue($this->statuses()->hasRefunding('REFUNDING'));

        $this->assertFalse($this->statuses()->hasRefunding('PARTIAL_REFUNDED'));
        $this->assertFalse($this->statuses()->hasRefunding('REFUNDED'));
        $this->assertFalse($this->statuses()->hasRefunding('REVERSED'));

        $this->assertFalse($this->statuses()->hasRefunding('ATTEMPTS_EXPIRED'));
        $this->assertFalse($this->statuses()->hasRefunding('CANCELED'));
        $this->assertFalse($this->statuses()->hasRefunding('DEADLINE_EXPIRED'));
        $this->assertFalse($this->statuses()->hasRefunding('REJECTED'));

        $this->assertFalse($this->statuses()->hasRefunding('CONFIRMED'));

        $this->assertFalse($this->statuses()->hasRefunding('UNKNOWN'));
    }

    public function testHasRefunded()
    {
        $this->assertFalse($this->statuses()->hasRefunded('FORM_SHOWED'));
        $this->assertFalse($this->statuses()->hasRefunded('NEW'));

        $this->assertFalse($this->statuses()->hasRefunded('AUTHORIZED'));
        $this->assertFalse($this->statuses()->hasRefunded('AUTHORIZING'));
        $this->assertFalse($this->statuses()->hasRefunded('CONFIRMING'));
        $this->assertFalse($this->statuses()->hasRefunded('REFUNDING'));

        $this->assertTrue($this->statuses()->hasRefunded('PARTIAL_REFUNDED'));
        $this->assertTrue($this->statuses()->hasRefunded('REFUNDED'));
        $this->assertTrue($this->statuses()->hasRefunded('REVERSED'));

        $this->assertFalse($this->statuses()->hasRefunded('ATTEMPTS_EXPIRED'));
        $this->assertFalse($this->statuses()->hasRefunded('CANCELED'));
        $this->assertFalse($this->statuses()->hasRefunded('DEADLINE_EXPIRED'));
        $this->assertFalse($this->statuses()->hasRefunded('REJECTED'));

        $this->assertFalse($this->statuses()->hasRefunded('CONFIRMED'));

        $this->assertFalse($this->statuses()->hasRefunded('UNKNOWN'));
    }

    public function testInProgress()
    {
        $this->assertTrue($this->statuses()->inProgress('FORM_SHOWED'));
        $this->assertTrue($this->statuses()->inProgress('NEW'));

        $this->assertTrue($this->statuses()->inProgress('AUTHORIZED'));
        $this->assertTrue($this->statuses()->inProgress('AUTHORIZING'));
        $this->assertTrue($this->statuses()->inProgress('CONFIRMING'));
        $this->assertTrue($this->statuses()->inProgress('REFUNDING'));

        $this->assertFalse($this->statuses()->inProgress('PARTIAL_REFUNDED'));
        $this->assertFalse($this->statuses()->inProgress('REFUNDED'));
        $this->assertFalse($this->statuses()->inProgress('REVERSED'));

        $this->assertFalse($this->statuses()->inProgress('ATTEMPTS_EXPIRED'));
        $this->assertFalse($this->statuses()->inProgress('CANCELED'));
        $this->assertFalse($this->statuses()->inProgress('DEADLINE_EXPIRED'));
        $this->assertFalse($this->statuses()->inProgress('REJECTED'));

        $this->assertFalse($this->statuses()->inProgress('CONFIRMED'));

        $this->assertTrue($this->statuses()->inProgress('UNKNOWN'));
    }

    protected function statuses(): Statuses
    {
        return Statuses::make()->model($this->model());
    }
}
