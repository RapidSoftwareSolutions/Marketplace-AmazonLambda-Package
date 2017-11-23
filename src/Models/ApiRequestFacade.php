<?php
namespace Models;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ServerException;

class ApiRequestFacade
{
    public static function makeRequest($params, $post_data, $query_str, $reqType = 'GET', $paramType = 'query')
    {

        $responseCode = ['200', '201', '204'];
        unset($params['responseCode']);

        try {
            $requestFacade = new \Models\RequestFacade();
            $resp = $requestFacade->makeRequest(new Client(), $params, $post_data, $query_str, $reqType, $paramType);

            $responseBody = $resp->getBody()->getContents();
            $rawBody = json_decode($resp->getBody());
            $all_data[] = $rawBody;
            if ( in_array($resp->getStatusCode(), $responseCode)) {
                $result['callback'] = 'success';
                $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
                $result['contextWrites']['to'] = $result['contextWrites']['to'][0]== null ? ["result" => "empty reply"] : $result['contextWrites']['to'];
            } else {
                $result['callback'] = 'error';
                $result['contextWrites']['to']['status_code'] = 'API_ERROR';
                $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            }

        } catch (\GuzzleHttp\Exception\ClientException $exception) {
            $responseBody = $exception->getResponse()->getBody()->getContents();
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = $responseBody;

        } catch (ServerException $exception) {

            $responseBody = $exception->getResponse()->getBody(true);
            $result['callback'] = 'error';
            $result['contextWrites']['to'] = json_decode($responseBody);

        } catch (BadResponseException $exception) {

            $responseBody = $exception->getResponse()->getBody(true);
            $result['callback'] = 'error';
            $result['contextWrites']['to'] = json_decode($responseBody);

        }
        return $result;
    }
}

