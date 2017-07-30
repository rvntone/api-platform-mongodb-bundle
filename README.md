# API Platform MongoDB Integration

This bundle provides a simple integration of the [Doctrine MongoDB][2] into [API Platform framework][1].

## Installation

Install the latest version with

```bash
$ composer require doublebit/api-platform-mongodb-bundle
```

Register the bundle in `app/AppKernel.php`:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new DoubleBit\APIPlatform\MongoDBBundle\DoubleBitAPIPlatformMongoDBBundle(),
    );
}
```

Configure
---------

`app/config/schema.yml`

``` yaml
annotationGenerators:
    - DoubleBit\APIPlatform\MongoDBBundle\AnnotationGenerator\DoctrineMongoDBAnnotationGenerator
namespaces:
    entity: AppBundle\Document # The default namespace for documents,
```

Usage
---------

```bash
$ bin/schema generate-types src/ app/config/schema.yml
```

License
-------

The DoubleBitAPIPlatformMongoDBBundle is licensed under the MIT license.

[1]: https://github.com/api-platform/api-platform
[2]: https://github.com/doctrine/mongodb
[3]: http://getcomposer.org/
