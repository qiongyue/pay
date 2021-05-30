<?php

declare(strict_types=1);

namespace Yansongda\Pay\Plugin\Alipay;

use Closure;
use Yansongda\Pay\Contract\PluginInterface;
use Yansongda\Pay\Rocket;
use Yansongda\Supports\Str;

class FilterPlugin implements PluginInterface
{
    /**
     * @return \Yansongda\Supports\Collection|\Symfony\Component\HttpFoundation\Response
     */
    public function assembly(Rocket $rocket, Closure $next)
    {
        $payload = $rocket->getPayload()->filter(function ($v, $k) {
            return '' !== $v && !is_null($v) && 'sign' != $k && Str::startsWith($k, '_');
        });

        $payload->set('biz_content', json_encode($payload->get('biz_content')));

        return $next($rocket->setPayload($payload));
    }
}
