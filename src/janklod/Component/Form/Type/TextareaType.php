<?php
namespace Jan\Component\Form\Type;


use Jan\Component\Form\Type\Support\BaseType;


/**
 * Class TextareaType
 * @package Jan\Component\Form\Type
*/
class TextareaType extends BaseType
{

    /**
     * @return string
     * @throws \Exception
    */
    public function build(): string
    {
        $attrs = $this->getOption('attr', []);
        $attributes = $this->makeAttributes($attrs);
        return sprintf('<textarea name="%s" %s></textarea>', $this->getChild(), $attributes);
    }
}