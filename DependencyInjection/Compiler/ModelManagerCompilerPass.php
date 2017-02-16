<?php
/**
 * Class ModelManagerCompilerPass
 * @package AdminProject\DoctrineOrmAdminBundle\DependencyInjection\Compiler
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */

namespace AdminProject\DoctrineOrmAdminBundle\DependencyInjection\Compiler;

use AdminProject\AdminBundle\Exception\Model\ModelManagerAlreadyRegisteredException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ModelManagerCompilerPass
 * @package AdminProject\DoctrineOrmAdminBundle\DependencyInjection\Compiler
 * @author Sebastian Seidelmann <sebastian.seidelmann@googlemail.com>
 */
class ModelManagerCompilerPass implements CompilerPassInterface
{
    /**
     * Process the compiler pass.
     * @param ContainerBuilder $container
     * @return void
     * @throws ModelManagerAlreadyRegisteredException
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('adminproject.model.manager.registry')) {
            throw new \RuntimeException('Service adminproject.model.manager.registry not available');
        }

        $registryDefinition = $container->findDefinition('adminproject.model.manager.registry');
        $registryDefinition->addMethodCall('registerModelManager', ['adminproject.manager.orm', new Reference('adminproject.manager.orm')]);
    }
}