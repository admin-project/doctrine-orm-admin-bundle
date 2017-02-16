<?php
/**
 * Class FieldMapperDescriptor
 * @package AdminProject\DoctrineOrmAdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */

namespace AdminProject\DoctrineOrmAdminBundle\FieldMapper;

use AdminProject\AdminBundle\FieldMapper\AbstractFieldMapperDescriptor;
use Doctrine\Common\Inflector\Inflector;

/**
 * Class FieldMapperDescriptor
 * @package AdminProject\DoctrineOrmAdminBundle\FieldMapper
 * @author Sebastian Seidelmann <sebastian.seidelmann@wfp2.com>, wfp:2 GmbH & Co. KG
 */
class FieldMapperDescriptor extends AbstractFieldMapperDescriptor
{
    /**
     * Returns the value for the field.
     * @param object $object
     * @return mixed
     */
    public function getValue($object)
    {
        $fieldName = $this->name;

        $camelizedFieldName = Inflector::classify($fieldName);

        $getters = [];
        $getters[] = 'get'.$camelizedFieldName;
        $getters[] = 'is'.$camelizedFieldName;

        foreach ($getters as $getter) {
            if (method_exists($object, $getter)) {
                return call_user_func_array(array($object, $getter), []);
            }
        }

        if (method_exists($object, '__call')) {
            return call_user_func_array(array($object, '__call'), array($fieldName, []));
        }

        if (isset($object->{$fieldName})) {
            return $object->{$fieldName};
        }
    }

}