<?php
namespace Jan\Component\Form\Type;


/**
 * Class RepeatPasswordType
 *
 * @package Jan\Component\Form\Type
*/
class RepeatPasswordType extends PasswordType
{
    /**
     * @return string
     * @throws \Exception
    */
    public function build(): string
    {
        // TODO Refactoring
        // name of input type (password)
        $name = $this->getName();

        //
        if($firstChild = $this->getOption('first_child')) {
            $name = $firstChild;
        }

        $html = parent::build();
        $html.= $this->formatHtml($name, $this->getOption('second_child'), $this->getOption('second_options'));
        return $html;
    }
}