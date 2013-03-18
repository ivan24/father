<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan oreskov ivan.oreshkov@gmail.com
 * Date: 17.03.13
 * Time: 12:03
 * To change this template use File | Settings | File Templates.
 */

namespace Form;


abstract class AbstractForm
{
    protected $field = array();
    abstract function view($data);
    abstract function validate();
    abstract function bind();
}