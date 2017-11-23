       <?php
       $routes = [
       'updateFunctionConfiguration',
       'updateFunctionCode',
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
       'createFunction',
       'createEventSourceMapping',
        'addPermission',
        'createAlias',
        'metadata'
       ];
       foreach ($routes as $file) {
           require __DIR__ . '/../src/routes/' . $file . '.php';
       }

