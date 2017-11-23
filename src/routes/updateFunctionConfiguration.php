<?php

use Aws\Lambda\LambdaClient;

$app->post('/api/AmazonLambda/updateFunctionConfiguration', function ($request, $response, $args) {
    $settings = $this->settings;


    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'version', 'region', 'functionName']);
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
        'Runtime' => $post_data['args']['runtime'],
        'Role' => $post_data['args']['role'],
        'Handler' => $post_data['args']['handler'],
        'Description' => $post_data['args']['description']
    ];
    if (isset($post_data['args']['timeout']) && $post_data['args']['timeout'] > 0) {
        $requestArray['Timeout'] = $post_data['args']['timeout'];
    }
    if (isset($post_data['args']['memorySize']) && $post_data['args']['memorySize'] > 0) {
        $requestArray['MemorySize'] = $post_data['args']['memorySize'];
    }
    try {
        $awsResult = $client->getFunction($requestArray);

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