<?php
class Mail
{
    protected $requireFields = array(
        'goods',
        'name',
        'email',
        'phone'
    );
    protected $errors = array();
    protected $sanitized = array(
        'goods' => '',
        'name' => '',
        'email' => '',
        'phone' => '',
        'msg' => ''
    );
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

                if ($this->sendMail($this->getSanitized())) {
                    header("Location:index.php?send=success");exit();
                }
            }
        }
    }

    public function sendMail($data)
    {
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // Additional headers
        $headers .= 'From: ' . $data['email'] . "\r\n";
        $date = new DateTime();
        $to = 'serge.oreshkov@gmail.com';
        $serverinfo = array();
        $serverinfo['remote_addr'] = $_SERVER['REMOTE_ADDR'] . " ( " . gethostbyaddr($_SERVER['REMOTE_ADDR']) . " )";
        $serverinfo['useragent'] = $_SERVER['HTTP_USER_AGENT'];
        $serverinfo['date'] = $date->format('Y-m-d H:i:s');

        $message = $this->render(
            'mailForm.php',
            array(
                'userinfo' => $data,
                'serverinfo' => $serverinfo
            )
        );
        return mail($to, 'Предварительный заказ', $message, $headers, '-f' . $data['email']);
    }

    public function render($filename, array $arg = array())
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
        return ob_get_clean();
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
