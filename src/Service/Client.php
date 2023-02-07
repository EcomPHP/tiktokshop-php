<?php

namespace NVuln\TiktokShop\Service;

class Client extends \NVuln\TiktokShop\Client
{
    protected $timeOut;

    /**
     * @param $app_key
     * @param $app_secret
     * @param $time_out
     * @param $shop_id
     * @param $sandbox
     */
    public function __construct($app_key, $app_secret, $time_out, $shop_id = null, $sandbox = false)
    {
        parent::__construct($app_key, $app_secret, $shop_id, $sandbox);
        $this->timeOut = $time_out;
    }

    /**
     * @return GuzzleHttpClient
     */
    protected function httpClient()
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::mapRequest(function (RequestInterface $request) {
            $uri = $request->getUri();
            parse_str($uri->getQuery(), $query);

            $query['app_key'] = $this->getAppKey();
            $query['timestamp'] = time();
            if ($this->shop_id && !isset($query['shop_id'])) {
                $query['shop_id'] = $this->shop_id;
            }

            if ($this->access_token && !isset($query['access_token'])) {
                $query['access_token'] = $this->access_token;
            }

            $this->prepareSignature($uri->getPath(), $query);

            $uri = $uri->withQuery(http_build_query($query));

            return $request->withUri($uri);
        }));

        $api_domain_endpoint = $this->sandbox ? 'open-api-sandbox.tiktokglobalshop.com' : 'open-api.tiktokglobalshop.com';

        return new GuzzleHttpClient([
            RequestOptions::HTTP_ERRORS => false, // disable throw exception, manual handle it
            RequestOptions::TIMEOUT => $this->timeOut,
            'handler' => $stack,
            'base_uri' => 'https://'.$api_domain_endpoint.'/api/',
        ]);
    }
}
