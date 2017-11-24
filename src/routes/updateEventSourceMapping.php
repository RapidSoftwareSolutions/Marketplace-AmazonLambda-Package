<?php

use Aws\Lambda\LambdaClient;

$app->post('/api/AmazonLambda/updateEventSourceMapping', function ($request, $response, $args) {
    $settings = $this->settings;


    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'version', 'region', 'uuid']);
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
        'UUID' => $post_data['args']['uuid'],
    ];
    if (isset($post_data['args']['enabled']) && strlen($post_data['args']['enabled']) > 0) {
        $requestArray['Enabled'] = $post_data['args']['enabled'] == 'true' ? true : false;
    }
    if (isset($post_data['args']['batchSize']) && strlen($post_data['args']['batchSize']) > 0) {
        $requestArray['BatchSize'] = (int)$post_data['args']['batchSize'];
    }
    if (isset($post_data['args']['functionName']) && strlen($post_data['args']['functionName']) > 0) {
        $requestArray['FunctionName'] = $post_data['args']['functionName'];
    }
    try {
        $awsResult = $client->updateEventSourceMapping($requestArray);
        $result['callback'] = 'success';
        $result['contextWrites']['to'] = $awsResult->toArray();
    } catch (InvalidArgumentException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
    } catch (Aws\Lambda\Exception\LambdaException $exception) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $exception->getMessage();
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});