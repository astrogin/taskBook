<?php

namespace app\requests;

class LoginRequest extends Request
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function getParams()
    {
        if (isset($this->data['login']) && strlen($this->data['login']) > 1
            && isset($this->data['password']) && strlen($this->data['password']) > 1
        ) {
            return $this->data;
        }

        throw new \Exception('Bad request', 400);
    }
}