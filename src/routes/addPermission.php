<?php

use Aws\Lambda\LambdaClient;

$app->post('/api/AmazonLambda/addPermission', function ($request, $response, $args) {
    $settings = $this->settings;


    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'version', 'region', 'functionName', 'statementId', 'action', 'principal']);
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
        'StatementId' => $post_data['args']['statementId'],
        'Action' => $post_data['args']['action'],
        'Principal' => $post_data['args']['principal'],
        'SourceArn' => $post_data['args']['sourceArn'],
        'SourceAccount' => $post_data['args']['sourceAccount']
    ];
    if (isset($post_data['args']['qualifier']) && strlen($post_data['args']['qualifier']) > 0) {
        $requestArray['Qualifier'] = $post_data['args']['qualifier'];
    }
    try {
        $awsResult = $client->addPermission($requestArray
        );
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