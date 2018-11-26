<?php

namespace app\requests;

class Request
{
    protected $data;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        foreach ($_REQUEST as $key => $item) {
            $this->data[$key] = $this->clean($item);
        }
    }

    /**
     * @param $value
     * @return string
     */
    protected function clean($value)
    {
        return htmlspecialchars($value);
    }
}

