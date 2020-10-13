<?php
namespace App\Helpers;

use GuzzleHttp\Client;


class StripeHelper {
    const STRIPE_URL = 'https://api.stripe.com/v1/';

    private static function getHttpClient() {
        return new Client([
            'base_uri' => self::STRIPE_URL,
            'auth' => [env('STRIPE_SECRET'), null]
        ]);
    }

    static function getPrices() {
        return array_filter(json_decode(self::getHttpClient()->get('prices')->getBody()->getContents())->data, function($price) {
            return $price->active;
        });
    }

    static function getPrice(String $id) {
        return json_decode(self::getHttpClient()->get("prices/$id")->getBody()->getContents());
    }

    static function getCustomer(string $stripeCustomerId) {
        return json_decode(self::getHttpClient()->get("customers/$stripeCustomerId")->getBody()->getContents());
    }

    static function getCustomerSubscriptions(string $stripeCustomerId) {
        return json_decode(self::getHttpClient()->get("customers/$stripeCustomerId/subscriptions")->getBody()->getContents())->data;
    }
}
