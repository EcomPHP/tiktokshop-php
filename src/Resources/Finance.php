<?php
/*
 * This file is part of tiktok-shop.
 *
 * (c) Jin <j@sax.vn>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EcomPHP\TiktokShop\Resources;

use GuzzleHttp\RequestOptions;
use EcomPHP\TiktokShop\Resource;

class Finance extends Resource
{
    protected $category = 'finance';

    public function getOrderStatementTransactions($order_id)
    {
        return $this->call('GET', 'orders/'.$order_id.'/statement_transactions');
    }

    public function getStatementTransactions($statement_id, $params = [])
    {
        $params = array_merge([
            'sort_field' => 'order_create_time', // required
        ], $params);

        return $this->call('GET', 'statements/'.$statement_id.'/statement_transactions', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getWithdrawals($params = [])
    {
        $params = array_merge([
            'types' => 'WITHDRAW,SETTLE,TRANSFER,REVERSE', // required, default get all
        ], $params);

        return $this->call('GET', 'withdrawals', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getStatements($params = [])
    {
        $params = array_merge([
            'sort_field' => 'statement_time', // required
        ], $params);

        return $this->call('GET', 'statements', [
            RequestOptions::QUERY => $params,
        ]);
    }

    public function getPayments($params = [])
    {
        $params = array_merge([
            'sort_field' => 'create_time', // required
        ], $params);

        return $this->call('GET', 'payments', [
            RequestOptions::QUERY => $params,
        ]);
    }
}
