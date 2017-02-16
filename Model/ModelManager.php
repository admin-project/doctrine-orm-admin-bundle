<?php
/**
 * Class ModelManager
 * @package AdminProject\DoctrineOrmAdminBundle\Model
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle\Model;

use AdminProject\AdminBundle\Model\ModelManagerInterface;
use AdminProject\AdminBundle\Model\Quer;
use Doctrine\ORM\EntityManager;

/**
 * Class ModelManager
 * @package AdminProject\DoctrineOrmAdminBundle\Model
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class ModelManager implements ModelManagerInterface
{
    /**
     * Saves the entity manager.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ModelManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    public function update($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    public function delete($object)
    {
        $this->entityManager->remove($object);
        $this->entityManager->flush();
    }

    public function findBy($class, array $criteria)
    {
        return $this->entityManager->getRepository($class)->findBy($criteria);
    }

    public function findOneBy($class, array $criteria)
    {
        return $this->entityManager->getRepository($class)->findOneBy($criteria);
    }

    public function find($class, $id)
    {
        return $this->entityManager->getRepository($class)->find($id);
    }

    /**
     * Returns the metadata for the class
     * @param string $class
     * @return \Doctrine\Common\Persistence\Mapping\ClassMetadata
     */
    public function getMetadata($class)
    {
        return $this->entityManager->getMetadataFactory()->getMetadataFor($class);
    }

    /**
     * Returns the query builder.
     * @param string $class
     * @param string $alias
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQuery($class, $alias = 'o')
    {
        return $this->entityManager->getRepository($class)->createQueryBuilder($alias);
    }


}