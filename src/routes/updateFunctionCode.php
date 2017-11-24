<?php

use Aws\Lambda\LambdaClient;

$app->post('/api/AmazonLambda/updateFunctionCode', function ($request, $response, $args) {
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
        'FunctionName' => $post_data['args']['functionName']
    ];
    if (isset($post_data['args']['zipFile']) && strlen($post_data['args']['zipFile']) > 0) {
        $requestArray['ZipFile'] = $post_data['args']['zipFile'];
    }
    if (isset($post_data['args']['s3Bucket']) && strlen($post_data['args']['s3Bucket']) > 0) {
        $requestArray['S3Bucket'] = $post_data['args']['s3Bucket'];
    }
    if (isset($post_data['args']['s3Key']) && strlen($post_data['args']['s3Key']) > 0) {
        $requestArray['S3Key'] = $post_data['args']['s3Key'];
    }
    if (isset($post_data['args']['s3ObjectVersion']) && strlen($post_data['args']['s3ObjectVersion']) > 0) {
        $requestArray['S3ObjectVersion'] = $post_data['args']['s3ObjectVersion'];
    }
    if (isset($post_data['args']['publish']) && strlen($post_data['args']['publish']) > 0) {
        $requestArray['Publish'] = $post_data['args']['publish'] == 'true' ? true : false;
    }
    try {


        $awsResult = $client->updateFunctionCode($requestArray);
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