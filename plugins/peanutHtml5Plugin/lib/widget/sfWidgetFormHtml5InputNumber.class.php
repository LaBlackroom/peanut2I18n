<?php

/**
 * Generate an html5 input type="number"
 *
 * @package peanut5Plugin
 * @subpackage widget
 * @author Alexandre 'pocky' Balmes <albalmes@gmail.com>
 */


class sfWidgetFormHtml5InputNumber extends sfWidgetFormHtml5Input
{

  /**
   * Constructor.
   *
   * Available options:
   *
   *  * min: Minimum acceptable value for this field
   *  * max: Maximum acceptable value
   *  * step: Combined with the min value, define the acceptable numbers in the range up to the max value
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see http://dev.w3.org/html5/markup/input.number.html
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    parent::configure($options, $attributes);

    $this->setOption('type', 'number');
    
    $this->addOption('min', null);
    $this->addOption('max', null);
    $this->addOption('step', false);
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if(!is_null($this->getOption('min')) && !is_null($this->getOption('max')))
    {
      if(!is_null($this->getOption('min')))
      {
        if($this->getOption('min') < $this->getOption('max'))
        {
          $attributes['min'] = $this->getOption('min');
        }
        else
        {
          throw new sfRenderException('min option must be inferior of max option');
        }
      }

      if(!is_null($this->getOption('max')))
      {
        if($this->getOption('max') > $this->getOption('min'))
        {
          $attributes['max'] = $this->getOption('max');
        }
        else
        {
          throw new sfRenderException('max option must be superior of min option');
        }
      }

      if($this->getOption('step'))
      {
        if(($this->getOption('step') > $this->getOption('min') && $this->getOption('step') < $this->getOption('max'))
              || $this->getOption('step') == 'any')
        {
          $attributes['step'] = $this->getOption('step');
        }
        else
        {
          throw new sfRenderException('step option must be in the range of min and max option');
        }
      }
    }

    foreach($attributes as $key => $val)
    {
      if(preg_match('/,/', $val))
      {
        $attributes[$key] = preg_replace('/,/', '.', $val);
      }

      if(is_numeric($val) || $this->getOption('step') == 'any')
      {
        $attrinutes[$key] = $val;
      }
      else
      {
        throw new sfRenderException(sprintf('Option %s must be a numeric value', $key));
      }

    }

    return parent::render($name, $value, $attributes, $errors);
  }

}
