<?php
/**
 * Class Pager
 * @package AdminProject\DoctrineOrmAdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle\Datagrid;

use AdminProject\AdminBundle\Datagrid\AbstractPager;
use AdminProject\DoctrineOrmAdminBundle\Model\Proxy\QueryProxy;
use Doctrine\ORM\QueryBuilder;

/**
 * Class Pager
 * @package AdminProject\DoctrineOrmAdminBundle\Datagrid
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class Pager extends AbstractPager
{
    /**
     * Initialize the pager.
     * @return mixed
     */
    public function init()
    {
        $this->setNumberResults($this->computeNumberResult());

        $this->getQuery()->setFirstResult(null);
        $this->getQuery()->setMaxResults(null);

        if ($this->getPage() == 0 || $this->getNumberResults() == 0 || $this->getMax() == 0) {
            $this->setLastPage(0);
        } else {
            $maxResults  = $this->getMax();
            $firstResult = ($this->getPage() - 1) * $maxResults;

            $this->getQuery()->setFirstResult($firstResult);
            $this->getQuery()->setMaxResults($maxResults);

            $this->setLastPage(ceil($this->getNumberResults() / $this->getMax()));
        }
    }

    /**
     * Computes the number result
     * @return int
     */
    public function computeNumberResult()
    {
        /* @var $queryBuidler QueryBuilder */
        $queryBuidler = clone $this->getQuery()->getQueryBuilder();

        $queryBuidler->setMaxResults(null);
        $queryBuidler->setFirstResult(null);

        $queryBuidler->select(sprintf(
            'count(DISTINCT %s.id) as cnt',
            $queryBuidler->getRootAlias()
        ));

        return $queryBuidler->getQuery()->getSingleScalarResult();
    }

    /**
     * Returns the results.
     * @return array
     */
    public function getResults()
    {
        return $this->getQuery()->execute();
    }
}