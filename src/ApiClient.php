<?php

namespace Devrusspace\KennwortYii2;

class ApiClient extends \yii\base\Component
{
    public $token;
    public $defaultSenderId;

    private $_client;

    public function __construct($config = [])
    {
        if (!empty($config)) {
            \Yii::configure($this, $config);
        }

        if (empty($this->token)) {
            throw new \Exception('Kennwort-email-sender token cannot be empty');
        }
    }

    private function getClient()
    {
        if (!$this->_client) {
            $this->_client = new \Devrusspace\Kennwort\ApiClient($this->token);
        }
        return $this->_client;
    }

    public function  __call($method, $parameters)
    {
        if(method_exists($this->getClient(), $method))
        {
            return call_user_func_array([$this->getClient(), $method], $parameters);
        }
    }

    /**
     * Отправка письма, сгенерированного на стороне вашего приложения
     *
     * @param array $user ["email" => "Имя получателя"]
     * @param string $subject Заголовок письма
     * @param string $body Контент письма, в формате html
     * @return object
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendEmailDefaultSenderBody($user, $subject, $body)
    {
        if (empty($this->defaultSenderId)) {
            throw new \Exception('Kennwort-email-sender defaultSenderId cannot be empty');
        }

        return $this->sendEmailBody($this->defaultSenderId, $user, $subject, $body);
    }
}