Installation
============

Download the Bundle
-------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: bash

    $ composer require admin-project/doctrine-orm-admin-bundle

Enable the Bundle
-----------------

.. code-block:: php

    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...
                new AdminProject\AdminBundle\AdminProjectDoctrineOrmAdminBundle(),
            );

            // ...
        }

        // ...
    }
