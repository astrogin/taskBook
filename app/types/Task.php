<?php

namespace app\types;

class Task
{
    private $firstName;
    private $lastName;
    private $email;
    private $description;
    private $image;

    /**
     * Task constructor.
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $description
     * @param Image $image
     */
    public function __construct(string $firstName, string $lastName, string $email, string $description, Image $image)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->image;
    }
}