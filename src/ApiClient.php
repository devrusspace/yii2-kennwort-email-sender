<?php

namespace Devrusspace\KennwortYii2;

class ApiClient extends \Devrusspace\Kennwort\ApiClient
{
    public $token;
    public $defaultSenderId;

    private $_api;

    public function __construct()
    {
        if (empty($this->token)) {
            throw new \Exception('Kennwort-email-sender token cannot be empty');
        }

        parent::__construct($this->token);
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
