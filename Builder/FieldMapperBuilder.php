<?php
/**
 * Class FieldMapperBuilder
 * @package AdminProject\DoctrineOrmAdminBundle\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle\Builder;

use AdminProject\AdminBundle\Admin\AbstractAdmin;
use AdminProject\AdminBundle\FieldMapper\FieldMapper;
use AdminProject\AdminBundle\FieldMapper\FieldMapperBuilderInterface;
use AdminProject\DoctrineOrmAdminBundle\FieldMapper\FieldMapperDescriptor;
use AdminProject\DoctrineOrmAdminBundle\Model\ModelManager;

/**
 * Class FieldMapperBuilder
 * @package AdminProject\DoctrineOrmAdminBundle\Builder
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class FieldMapperBuilder implements FieldMapperBuilderInterface
{
    /**
     * Saves the model manager.
     * @var ModelManager
     */
    private $modelManager;

    /**
     * FieldMapperBuilder constructor.
     * @param ModelManager $modelManager
     */
    public function __construct(ModelManager $modelManager)
    {
        $this->modelManager = $modelManager;
    }

    /**
     * creates the field mapping.
     * @param AbstractAdmin $admin
     * @return FieldMapper
     */
    public function createFieldMapping(AbstractAdmin $admin)
    {
        $metadata = $this->modelManager->getMetadata($admin->getEntityClass());

        $fieldMapper = new FieldMapper();

        foreach ($metadata->getFieldNames() as $fieldName) {
            $type = $metadata->getTypeOfField($fieldName);
            $descriptor = new FieldMapperDescriptor(
                $admin,
                $fieldName,
                $type
            );
            $fieldMapper->addField($descriptor);
        }

        return $fieldMapper;
    }

    public function getValueForField($object, $field)
    {

    }
}