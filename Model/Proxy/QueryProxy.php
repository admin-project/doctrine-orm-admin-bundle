<?php
/**
 * Class QueryProxy
 * @package AdminProject\DoctrineOrmAdminBundle\Model\Proxy
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle\Model\Proxy;

use AdminProject\AdminBundle\Model\Proxy\QueryProxyInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Class QueryProxy
 * @package AdminProject\DoctrineOrmAdminBundle\Model\Proxy
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class QueryProxy implements QueryProxyInterface
{
    /**
     * Saves the doctrine ORM query Builder instance.
     * @var QueryBuilder
     */
    private $queryBuilder;

    /**
     * QueryProxy constructor.
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Calls the query method.
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public function __call($name, array $arguments)
    {
        return call_user_func_array([$this->queryBuilder, $name], $arguments);
    }

    /**
     * Clones the query proxy.
     * @return void
     */
    public function __clone()
    {
        $this->queryBuilder = clone $this->queryBuilder;
    }

    /**
     * Returns the query builder.
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    /**
     * Executes the query.
     * @param array $params
     * @param null $hydrationMode
     * @return mixed
     */
    public function execute(array $params = array(), $hydrationMode = null)
    {
         return $this->queryBuilder->getQuery()->execute($params, $hydrationMode);
    }

    /**
     * Sets the first result.
     * @param int $firstResult
     * @return void
     */
    public function setFirstResult($firstResult)
    {
        $this->queryBuilder->setFirstResult($firstResult);
    }

    /**
     * Sets the max results.
     * @param int $maxResults
     * @return void
     */
    public function setMaxResults($maxResults)
    {
        $this->queryBuilder->setMaxResults($maxResults);
    }


    /* ----------- Query builder methods ----------- */

    /**
     * Select method
     * @param null $select
     * @return QueryBuilder
     */
    public function select($select = null)
    {
        return $this->queryBuilder->select($select);
    }
}