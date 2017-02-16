<?php
/**
 * Class DatagridBuilder
 * @package AdminProject\DoctrineOrmAdminBundle\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle\Builder;

use AdminProject\AdminBundle\Admin\AbstractAdmin;
use AdminProject\AdminBundle\Datagrid\Datagrid;
use AdminProject\AdminBundle\Datagrid\DatagridBuilderInterface;

/**
 * Class DatagridBuilder
 * @package AdminProject\DoctrineOrmAdminBundle\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class DatagridBuilder implements DatagridBuilderInterface
{
    /**
     * creates the base datagrid
     * @return Datagrid
     */
    public function createBaseDatagrid(AbstractAdmin $admin)
    {
        return new Datagrid(
            $admin->createQuery()
        );
    }
}