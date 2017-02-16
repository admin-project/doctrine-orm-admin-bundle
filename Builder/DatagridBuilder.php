<?php
/**
 * Class DatagridBuilder
 * @package AdminProject\DoctrineOrmAdminBundle\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle\Builder;

use AdminProject\AdminBundle\Admin\AbstractAdmin;
use AdminProject\AdminBundle\Datagrid\AbstractDatagridBuilder;
use AdminProject\AdminBundle\Datagrid\Datagrid;
use AdminProject\AdminBundle\Datagrid\PagerInterface;
use AdminProject\DoctrineOrmAdminBundle\Datagrid\Pager;

/**
 * Class DatagridBuilder
 * @package AdminProject\DoctrineOrmAdminBundle\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class DatagridBuilder extends AbstractDatagridBuilder
{
    /**
     * Creates the base datagrid.
     * @param AbstractAdmin $admin
     * @param array         $parameters
     * @param string        $pagerType
     * @return Datagrid
     */
    public function createBaseDatagrid(AbstractAdmin $admin, array $parameters = [], $pagerType = PagerInterface::PAGER_TYPE_SIMPLE)
    {
        return new Datagrid(
            $admin->createQuery(),
            $this->getPager($pagerType),
            $this->getFilterFormBuilder(),
            $parameters
        );
    }

    /**
     * Returns the pager.
     * @param string $pagerType
     * @return Pager
     */
    private function getPager($pagerType)
    {
        if ($pagerType == PagerInterface::PAGER_TYPE_SIMPLE) {
            $pager = new Pager();
        } else {
            $pager = new Pager();
        }

        return $pager;
    }
}