<?php
/**
 * Class AdminProjectDoctrineOrmAdminBundle
 * @package AdminProject\DoctrineOrmAdminBundle
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle;

use AdminProject\DoctrineOrmAdminBundle\DependencyInjection\Compiler\ModelManagerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AdminProjectDoctrineOrmAdminBundle
 * @package AdminProject\DoctrineOrmAdminBundle
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class AdminProjectDoctrineOrmAdminBundle extends Bundle
{
    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     *
     * This method can be overridden to register compilation passes,
     * other extensions, ...
     *
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ModelManagerCompilerPass());
    }
}
