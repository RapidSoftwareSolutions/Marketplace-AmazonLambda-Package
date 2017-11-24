[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/AmazonLambda/functions?utm_source=RapidAPIGitHub_AmazonLambdaFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# AmazonLambda Package
AWS Lambda is a compute service that lets you run code without provisioning or managing servers.
* Domain: [AmazonLambda](https://aws.amazon.com/lambda/)
* Credentials: apiKey, apiSecret

## How to get credentials: 
0. Go to [Amazon Console](https://console.aws.amazon.com/console/home)
1. Register or log in
2. Create new user and assign to existing group. After creating user you will see credentials



## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 

## AmazonLambda.addPermission
Adds a permission to the resource policy associated with the specified AWS Lambda function. 

| Field        | Type       | Description
|--------------|------------|----------
| apiKey       | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret    | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region       | String     | Your Amazon region
| version      | String     | Your Amazon Lambda service version
| functionName | String     | Name of the Lambda function
| statementId  | String     | A unique statement identifier.
| action       | String     | The AWS Lambda action you want to allow in this statement. Each Lambda action is a string starting with "lambda:" followed by the API name .
| principal    | String     | The principal who is getting this permission. 
| sourceArn    | String     | This is optional; however, when granting Amazon S3 permission to invoke your function, you should specify this field with the bucket Amazon Resource Name (ARN) as its value.
| sourceAccount| String     | The AWS account ID (without a hyphen) of the source owner.
| qualifier    | String     | You can specify this optional query parameter to specify function version or alias name

## AmazonLambda.createAlias
Creates an alias to the specified Lambda function version.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret      | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region         | String     | Your Amazon region
| version        | String     | Your Amazon Lambda service version
| functionName   | String     | Name of the Lambda function
| functionVersion| String     | Version of the Lambda function
| aliasName      | String     | Alias of the Lambda function
| description    | String     | Description of the alias

## AmazonLambda.createEventSourceMapping
Identifies a stream as an event source for a Lambda function. It can be either an Amazon Kinesis stream or an Amazon DynamoDB stream.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret       | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region          | String     | Your Amazon region
| version         | String     | Your Amazon Lambda service version
| functionName    | String     | Name of the Lambda function
| eventSourceArn  | String     | The Amazon Resource Name (ARN) of the Amazon Kinesis or the Amazon DynamoDB stream that is the event source.
| startingPosition| Select     | The position in the stream where AWS Lambda should start reading. 
| enabled         | Select     | Indicates whether AWS Lambda should begin polling the event source. By default, Enabled is true.
| batchSize       | Number     | The largest number of records that AWS Lambda will retrieve from your event source at the time of invoking your function. Your function receives an event with all the retrieved records. The default is 100 records.

## AmazonLambda.createFunction
Creates a new Lambda function using direct link.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| runtime     | String     | The runtime environment for the Lambda function you are uploading.
| role        | String     | The Amazon Resource Name (ARN) of the IAM role that Lambda assumes when it executes your function to access any other Amazon Web Services (AWS) resources.
| handler     | String     | The function within your code that Lambda calls to begin execution. For Node.js, it is the module-name.export value in your function. For Java, it can be package.class-name::handler or package.class-name.
| zipFile     | String     | A base64-encoded .zip file containing your deployment package.
| description | String     | A short, user-defined function description. Lambda does not use this value. Assign a meaningful description as you see fit.
| timeout     | Number     | The function execution time at which Lambda should terminate the function. Because the execution time has cost implications, we recommend you set this value based on your expected execution time. The default is 3 seconds.
| memorySize  | Number     | The amount of memory, in MB, your Lambda function is given. Lambda uses this memory size to infer the amount of CPU and memory allocated to your function. Your function use-case determines your CPU and memory requirements. For example, a database operation might need less memory compared to an image processing function. The default value is 128 MB. The value must be a multiple of 64 MB.
| publish     | Select     | This boolean parameter can be used to request AWS Lambda to create the Lambda function and publish a version as an atomic operation.

## AmazonLambda.createFunctionWithBucket
Creates a new Lambda function using S3 bucket.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret      | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region         | String     | Your Amazon region
| version        | String     | Your Amazon Lambda service version
| functionName   | String     | Name of the Lambda function
| runtime        | String     | The runtime environment for the Lambda function you are uploading.
| role           | String     | The Amazon Resource Name (ARN) of the IAM role that Lambda assumes when it executes your function to access any other Amazon Web Services (AWS) resources.
| handler        | String     | The function within your code that Lambda calls to begin execution. For Node.js, it is the module-name.export value in your function. For Java, it can be package.class-name::handler or package.class-name.
| s3Bucket       | String     | Amazon S3 bucket name where the .zip file containing your deployment package is stored. This bucket must reside in the same AWS region where you are creating the Lambda function.
| s3Key          | String     | The Amazon S3 object (the deployment package) key name you want to upload.
| s3ObjectVersion| String     | The Amazon S3 object (the deployment package) version you want to upload.
| description    | String     | A short, user-defined function description. Lambda does not use this value. Assign a meaningful description as you see fit.
| timeout        | Number     | The function execution time at which Lambda should terminate the function. Because the execution time has cost implications, we recommend you set this value based on your expected execution time. The default is 3 seconds.
| memorySize     | Number     | The amount of memory, in MB, your Lambda function is given. Lambda uses this memory size to infer the amount of CPU and memory allocated to your function. Your function use-case determines your CPU and memory requirements. For example, a database operation might need less memory compared to an image processing function. The default value is 128 MB. The value must be a multiple of 64 MB.
| publish        | Select     | This boolean parameter can be used to request AWS Lambda to create the Lambda function and publish a version as an atomic operation.

## AmazonLambda.deleteAlias
Deletes an alias to the specified Lambda function version.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| aliasName   | String     | Alias of the Lambda function

## AmazonLambda.deleteEventSourceMapping
Removes an event source mapping. This means AWS Lambda will no longer invoke the function for events in the associated source.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret| credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region   | String     | Your Amazon region
| version  | String     | Your Amazon Lambda service version
| uuid     | String     | The event source mapping ID.

## AmazonLambda.deleteFunction
Deletes a specified Lambda function.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| qualifier   | String     | Using this optional parameter you can specify a function version (but not the $LATEST version) to direct AWS Lambda to delete a specific function version.

## AmazonLambda.getAlias
Retreives an alias to the specified Lambda function.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| aliasName   | String     | Alias of the Lambda function

## AmazonLambda.getEventSourceMapping
Returns configuration information for the specified event source mapping

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret| credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region   | String     | Your Amazon region
| version  | String     | Your Amazon Lambda service version
| uuid     | String     | The event source mapping ID.

## AmazonLambda.getFunction
Returns the configuration information of the Lambda function and a presigned URL link to the .zip file you uploaded with CreateFunction so you can download the .zip file. Note that the URL is valid for up to 10 minutes.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| qualifier   | String     | Using this optional parameter to specify a function version or alias name. 

## AmazonLambda.getFunctionConfiguration
Returns the configuration information of the Lambda function. This the same information you provided as parameters when uploading the function by using CreateFunction.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| qualifier   | String     | Using this optional parameter to specify a function version or alias name. 

## AmazonLambda.getPolicy
Returns the resource policy, containing a list of permissions that apply to a specific to an ARN that you specify via the Qualifier parameter.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| qualifier   | String     | Using this optional parameter to specify a function version or alias name. 

## AmazonLambda.invoke
Invokes a specific Lambda function version.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret     | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region        | String     | Your Amazon region
| version       | String     | Your Amazon Lambda service version
| functionName  | String     | Name of the Lambda function
| invocationType| Select     | By default, the Invoke API assumes "RequestResponse" invocation type. 
| logType       | Select     | You can set this optional parameter to "Tail" in the request only if you specify the InvocationType parameter with value "RequestResponse". In this case, AWS Lambda returns the base64-encoded last 4 KB of log data produced by your Lambda function in the x-amz-log-results header.
| clientContext | String     | Using the clientContext you can pass client-specific information to the Lambda function you are invoking.
| payload       | JSON       | JSON that you want to provide to your Lambda function as input.
| qualifier     | String     | Using this optional parameter to specify a function version or alias name. 

## AmazonLambda.listAliases
Returns list of aliases created for a Lambda function. 

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret      | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region         | String     | Your Amazon region
| version        | String     | Your Amazon Lambda service version
| functionName   | String     | Name of the Lambda function
| functionVersion| String     | If you specify this optional parameter, the API returns only the aliases pointing to the specific Lambda function version, otherwise returns all aliases created for the Lambda function.
| marker         | String     | An opaque pagination token returned from a previous ListAliases operation. If present, indicates where to continue the listing.
| maxItems       | Number     | Specifies the maximum number of aliases to return in response. This parameter value must be greater than 0.

## AmazonLambda.listEventSourceMappings
Returns a list of event source mappings you created using the createEventSourceMapping , where you identify a stream as an event source. This list does not include Amazon S3 event sources.

| Field         | Type       | Description
|---------------|------------|----------
| apiKey        | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret     | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region        | String     | Your Amazon region
| version       | String     | Your Amazon Lambda service version
| functionName  | String     | Name of the Lambda function
| eventSourceArn| String     | The Amazon Resource Name (ARN) of the Amazon Kinesis stream.
| marker        | String     | An opaque pagination token returned from a previous listEventSourceMappings operation. If present, indicates where to continue the listing.
| maxItems      | Number     | Specifies the maximum number of aliases to return in response. This parameter value must be greater than 0.

## AmazonLambda.listFunctions
Returns a list of your Lambda functions. For each function, the response includes the function configuration information. You must use GetFunction to retrieve the code for your function.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret| credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region   | String     | Your Amazon region
| version  | String     | Your Amazon Lambda service version
| marker   | String     | An opaque pagination token returned from a previous listFunctions operation. If present, indicates where to continue the listing.
| maxItems | Number     | Specifies the maximum number of aliases to return in response. This parameter value must be greater than 0.

## AmazonLambda.listVersionsByFunction
List all versions of a function.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| marker      | String     | An opaque pagination token returned from a previous listVersionsByFunction operation. If present, indicates where to continue the listing.
| maxItems    | Number     | Specifies the maximum number of aliases to return in response. This parameter value must be greater than 0.

## AmazonLambda.publishVersion
Publishes a version of your function from the current snapshot of HEAD. 

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| codeSha256  | String     | The SHA256 hash of the deployment package you want to publish. This provides validation on the code you are publishing. If you provide this parameter value must match the SHA256 of the HEAD version for the publication to succeed.
| description | String     | The description for the version you are publishing. If not provided, AWS Lambda copies the description from the HEAD version.

## AmazonLambda.removePermission
You can remove individual permissions from an resource policy associated with a Lambda function by providing a statement ID that you provided when you addded the permission. 

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| statementId | String     | Statement ID of the permission to remove.
| qualifier   | String     | You can specify this optional query parameter to specify function version or alias name

## AmazonLambda.updateAlias
Using this API you can update function version to which the alias points to and alias description.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret      | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region         | String     | Your Amazon region
| version        | String     | Your Amazon Lambda service version
| functionName   | String     | Name of the Lambda function
| functionVersion| String     | Version of the Lambda function
| aliasName      | String     | Alias of the Lambda function
| description    | String     | Description of the alias

## AmazonLambda.updateEventSourceMapping
You can update an event source mapping. This is useful if you want to change the parameters of the existing mapping without losing your position in the stream.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| uuid        | String     | The event source mapping ID.
| enabled     | Select     | Indicates whether AWS Lambda should begin polling the event source. By default, Enabled is true.
| batchSize   | Number     | The largest number of records that AWS Lambda will retrieve from your event source at the time of invoking your function. Your function receives an event with all the retrieved records. The default is 100 records.

## AmazonLambda.updateFunctionCode
Updates the code for the specified Lambda function with direct link. This operation must only be used on an existing Lambda function and cannot be used to update the function configuration.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret      | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region         | String     | Your Amazon region
| version        | String     | Your Amazon Lambda service version
| functionName   | String     | Name of the Lambda function
| zipFile        | String     | A .zip file containing your deployment package.
| publish        | Select     | This boolean parameter can be used to request AWS Lambda to create the Lambda function and publish a version as an atomic operation.

## AmazonLambda.updateFunctionCodeWithBucket
Updates the code for the specified Lambda function with s3 bucket. This operation must only be used on an existing Lambda function and cannot be used to update the function configuration.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret      | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region         | String     | Your Amazon region
| version        | String     | Your Amazon Lambda service version
| functionName   | String     | Name of the Lambda function
| s3Bucket       | String     | Amazon S3 bucket name where the .zip file containing your deployment package is stored. This bucket must reside in the same AWS region where you are creating the Lambda function.
| s3Key          | String     | The Amazon S3 object (the deployment package) key name you want to upload.
| s3ObjectVersion| String     | The Amazon S3 object (the deployment package) version you want to upload.
| publish        | Select     | This boolean parameter can be used to request AWS Lambda to create the Lambda function and publish a version as an atomic operation.

## AmazonLambda.updateFunctionConfiguration
Updates the configuration parameters for the specified Lambda function by using the values provided in the request. You provide only the parameters you want to change. This operation must only be used on an existing Lambda function and cannot be used to update the function's code.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Your Amazon AWS_ACCESS_KEY_ID
| apiSecret   | credentials| Your Amazon AWS_SECRET_ACCESS_KEY
| region      | String     | Your Amazon region
| version     | String     | Your Amazon Lambda service version
| functionName| String     | Name of the Lambda function
| runtime     | String     | The runtime environment for the Lambda function you are uploading.
| role        | String     | The Amazon Resource Name (ARN) of the IAM role that Lambda assumes when it executes your function to access any other Amazon Web Services (AWS) resources.
| handler     | String     | The function within your code that Lambda calls to begin execution. For Node.js, it is the module-name.export value in your function. For Java, it can be package.class-name::handler or package.class-name.
| description | String     | A short, user-defined function description. Lambda does not use this value. Assign a meaningful description as you see fit.
| timeout     | Number     | The function execution time at which Lambda should terminate the function. Because the execution time has cost implications, we recommend you set this value based on your expected execution time. The default is 3 seconds.
| memorySize  | Number     | The amount of memory, in MB, your Lambda function is given. Lambda uses this memory size to infer the amount of CPU and memory allocated to your function. Your function use-case determines your CPU and memory requirements. For example, a database operation might need less memory compared to an image processing function. The default value is 128 MB. The value must be a multiple of 64 MB.

