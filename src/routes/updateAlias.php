<?php

use Aws\Lambda\LambdaClient;

$app->post('/api/AmazonLambda/updateAlias', function ($request, $response, $args) {
    $settings = $this->settings;


    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'version', 'region', 'functionName', 'aliasName']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $client = new LambdaClient(
        array(
            'credentials' => [
                'key' => $post_data['args']['apiKey'],
                'secret' => $post_data['args']['apiSecret']
            ],
            'version' => $post_data['args']['version'],
            'region' => $post_data['args']['region']
        )
    );
    $requestArray = [
        'FunctionName' => $post_data['args']['functionName'],
        'Name' => $post_data['args']['aliasName'],
        'Description' => $post_data['args']['description']
    ];
    if (isset($post_data['args']['functionVersion']) && strlen($post_data['args']['functionVersion']) > 0) {
        $requestArray['FunctionVersion'] = $post_data['args']['functionVersion'];
    }
    try {
        $awsResult = $client->updateAlias($requestArray);
        $result['callback'] = 'success';
        $result['contextWrites']['to'] = $awsResult->toArray();
    } catch (InvalidArgumentException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
    } catch (Aws\Lambda\Exception\LambdaException $exception){
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});