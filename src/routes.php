       <?php
       $routes = [
       'updateFunctionConfiguration',
       'updateFunctionCode',
       'updateFunctionCodeWithBucket',
       'updateEventSourceMapping',
       'updateAlias',
       'removePermission',
       'publishVersion',
       'listVersionsByFunction',
       'listFunctions',
       'listEventSourceMappings',
       'listAliases',
       'invoke',
       'getPolicy',
       'getFunctionConfiguration',
       'getFunction',
       'getEventSourceMapping',
       'getAlias',
       'deleteFunction',
       'deleteEventSourceMapping',
       'deleteAlias',
       'createFunctionWithBucket',
       'createFunction',
       'createEventSourceMapping',
        'addPermission',
        'createAlias',
        'metadata'
       ];
       foreach ($routes as $file) {
           require __DIR__ . '/../src/routes/' . $file . '.php';
       }

