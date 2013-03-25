<?php
class Mail
{
    protected $requireFields = array(
        'goods',
        'name',
        'email',
        'phone'
    );
    protected $fields = array(
        'goods' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
        'msg' => ''
    );
    protected $errors = array();
    protected $sanitized = array();
    protected $messages = array(
        'require' => "Это поле не может быть пустым",
        'email_invalid_error' => "Введен не верный электронный адресс"
    );

    public function __construct()
    {
        if (isset($_POST) && !empty($_POST['user'])) {
            $this->sanitazeData($_POST['user']);
            $this->validate();
            $errors = $this->getErrors();
            if (!count($errors)) {
                $this->sendMail($this->getSanitized());
            }
        }
        return $this->render('orderForm.php', $this->getFields());
    }

    public function sendMail($data)
    {

    }

    public function render($filename, array $arg)
    {
        ob_start();
         extract($arg);
        if (empty($filename)) {
            $filename = 'orderForm.php';
        }
        $file = realpath(__DIR__ . '/template/' . __CLASS__ . '/' . $filename);
        if (file_exists($file)) {
            require $file;
        }
        print ob_get_clean();
    }

    public function sanitazeData($data, $key = '')
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->sanitazeData($value, $key);
            }
        } else {
            $this->sanitized[$key] = htmlentities(nl2br($data), ENT_QUOTES, 'UTF-8');
        }
    }

    public function validate()
    {
        $data = $this->getSanitized();
        foreach ($this->getRequireFields() as $required) {
            if (empty($data[$required])) {
                $this->setErrors($required, $this->messages['require']);
            }
        }
        $email_regexp = "/^(?:[a-z0-9]+(?:[a-z0-9\-_\.]+)?@[a-z0-9]+(?:[a-z0-9\-\.]+)?\.[a-z]{2,5})$/i";
        if (!preg_match($email_regexp, $data['email'])) {
            $this->setErrors('email', $this->messages['email_invalid_error']);
        }
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getSanitized()
    {
        return $this->sanitized;
    }

    public function getRequireFields()
    {
        return $this->requireFields;
    }

    public function setErrors($key, $value)
    {
        $this->errors[$key] = $value;
    }

    public function getError($key)
    {
        return ($this->errors[$key]) ? $this->errors[$key] : false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
