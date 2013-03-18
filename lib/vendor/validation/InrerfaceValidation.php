<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan oreskov ivan.oreshkov@gmail.com
 * Date: 17.03.13
 * Time: 1:58
 * To change this template use File | Settings | File Templates.
 */

namespace Validation;


abstract class AbstractValidation {
    protected static $allowEmpty = false;
    protected $error = "Это поле обязательно для заполнения";
    abstract function validate($data);
    function __construct($data)
    {
        if(!self::$allowEmpty && empty($data)) {
            return $this->getError();
        }
    }
    public function getError()
    {
        return $this->error;
    }
    public function setError($value)
    {
        return $this->error = $value;
    }

}