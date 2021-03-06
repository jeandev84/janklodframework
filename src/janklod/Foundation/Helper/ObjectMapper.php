<?php
namespace Jan\Foundation\Helper;


use Exception;
use ReflectionObject;


/**
 * Class ObjectMapper
 * @package Jan\Foundation\Helper
*/
class ObjectMapper
{

    protected $object;


    public function __construct($object)
    {
         $this->object = $object;
    }


    /**
     * @param object $object
     * @return array
     * @throws Exception
    */
    protected function getProperties($object = null): array
    {
        if($object) {
            $this->object = $object;
        }

        $mappedProperties = [];

        if(\is_object($this->object)) {

            $reflectedObject = new ReflectionObject($this->object);

            foreach($reflectedObject->getProperties() as $property) {
                $property->setAccessible(true);
                $mappedProperties[$property->getName()] = $property->getValue($this->object);
            }
        }

        return $mappedProperties;
    }


    /**
     * @param $objMapped
     * @param array $data
     * @return mixed
     * @throws Exception
    */
    public function assign($objMapped, array $data)
    {
        $reflectedObject = new \ReflectionObject($objMapped);
        foreach ($reflectedObject->getProperties() as $property) {
            $property->setAccessible(true);
            if(! \array_key_exists($field = $property->getName(), $data)) {
                throw new Exception('Cannot map property ('. $field .' )');
            }

            $property->setValue($objMapped, $data[$field]);
        }

        return $objMapped;
    }
}