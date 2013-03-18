<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivan oreskov ivan.oreshkov@gmail.com
 * Date: 17.03.13
 * Time: 1:56
 * To change this template use File | Settings | File Templates.
 */

namespace Fabric;
use \Validation;
include'../validation';

class ValidationFabric  implements InterfaceFabric
{
    const USER_NAME = 1;
    const USER_PASSWORD = 2;
    const USER_EMAIL = 3;
    const USER_GOODS = 4;
    function make($flag, $data)
    {
      switch ($flag) {
          case self::USER_EMAIL:
              return new UserNameValidation();
      }
    }
}