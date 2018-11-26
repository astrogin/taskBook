<?php

namespace app\services\fileService;

use app\types\Image;

class ImageService
{
    /**
     * @var Image
     */
    private $image;

    /**
     * ImageService constructor.
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function saveFile()
    {
        $uploadFileName = $this->getImageName() . $this->image->getType();
        $uploadFile = $this->getAbsoluteStoragePath() . $uploadFileName;

        $result = move_uploaded_file($this->image->getPath(), $uploadFile);

        if ($result) {
            return $this->getRelativeStoragePath() . $uploadFileName;
        }

        throw new \Exception("Upload error", 500);
    }

    /**
     * @return string
     */
    private function getAbsoluteStoragePath(): string
    {
        return __DIR__ . '/../../../storage/';
    }

    /**
     * @return string
     */
    private function getRelativeStoragePath(): string
    {
        return 'storage/';
    }

    /**
     * @return string
     */
    private function getImageName(): string
    {
        return str_replace(' ', '_', microtime());
    }
}