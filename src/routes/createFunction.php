<?php

use Aws\Lambda\LambdaClient;

$app->post('/api/AmazonLambda/createFunction', function ($request, $response, $args) {
    $settings = $this->settings;


    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'apiSecret', 'version', 'region', 'functionName', 'runtime', 'role', 'handler', 'zipFile', 's3Bucket', 's3Key', 's3ObjectVersion']);
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
    try {
        $awsResult = $client->createFunction(
            [
                'FunctionName' => $post_data['args']['functionName'],
                'Runtime' => $post_data['args']['runtime'],
                'Role' => $post_data['args']['role'],
                'Handler' => $post_data['args']['handler'],
                'Code' =>[
                    'ZipFile'=>$post_data['args']['zipFile'],
                    'S3Bucket'=>$post_data['args']['s3Bucket'],
                    'S3Key'=>$post_data['args']['s3Key'],
                    'S3ObjectVersion'=>$post_data['args']['s3ObjectVersion']
                ],
                'Description' => $post_data['args']['description'],
                'Timeout' => $post_data['args']['timeout'],
                'MemorySize' => $post_data['args']['memorySize'],
                'Publish' => $post_data['args']['publish']

            ]
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