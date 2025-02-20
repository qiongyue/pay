<?php

namespace Yansongda\Pay\Tests\Plugin\Alipay\User;

use Yansongda\Pay\Parser\ResponseParser;
use Yansongda\Pay\Plugin\Alipay\User\AgreementPageSignPlugin;
use Yansongda\Pay\Rocket;
use Yansongda\Pay\Tests\TestCase;

class AgreementPageSignPluginTest extends TestCase
{
    protected $plugin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->plugin = new AgreementPageSignPlugin();
    }

    public function testNormal()
    {
        $rocket = new Rocket();
        $rocket->setParams([]);

        $result = $this->plugin->assembly($rocket, function ($rocket) { return $rocket; });

        self::assertEquals(ResponseParser::class, $result->getDirection());
        self::assertStringContainsString('alipay.user.agreement.page.sign', $result->getPayload()->toJson());
        self::assertStringContainsString('CYCLE_PAY_AUTH', $result->getPayload()->toJson());
    }
}
