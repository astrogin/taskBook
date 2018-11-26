<?php

namespace app\types;

class Image
{
    private $name;
    private $type;
    private $path;
    private $size;

    /**
     * Image constructor.
     * @param string $name
     * @param string $type
     * @param string $path
     * @param string $size
     * @throws \Exception
     */
    public function __construct(string $name, string $type, string $path, string $size)
    {
        if (!file_exists($path) && getimagesize($path) === false) {
            throw new \Exception('It isn\'t an image', 422);
        }

        $this->name = $name;
        $this->type = $type;
        $this->path = $path;
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getMimeType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        switch ($this->type) {
            case "image/png":
                return '.png';
            case "image/gif":
                return '.gif';
            case "image/jpg":
                return '.jpg';
            default:
                return '.png';
        }
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }
}