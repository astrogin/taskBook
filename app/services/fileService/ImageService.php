<?php

namespace app\services\fileService;

use app\types\Image;

class ImageService
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function handle()
    {

    }
}