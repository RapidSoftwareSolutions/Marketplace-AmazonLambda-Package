<?php
namespace Models;

use GuzzleHttp\Client;

class RequestFacade
{

    public function makeRequest(Client $client, array $params, array $post_data, string $query_str, string $method, string $paramType)
    {

        foreach ($params as $key => $value) {
            if (strlen($post_data['args'][$value]) > 0) {
                $body[$key] = $post_data['args'][$value];
            }
        }
        $auth = 'Bearer ' . $post_data['args']['accessToken'];
        unset($body['accessToken']);
        $result = $client->request($method, $query_str, [
            'headers' => [
                'Authorization' => $auth,
                'Accept' => 'application/json'
            ],
            $paramType => $body
        ]);

        return $result;
    }

}
