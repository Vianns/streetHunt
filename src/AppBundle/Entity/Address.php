<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="city", length=255)
     *
     * @var string
     */
    private $city;

    /**
     * @ORM\Column(type="string", name="postal_code", length=255)
     *
     * @var string
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", name="first_field", length=255)
     *
     * @var string
     */
    private $firstField;

    /**
     * @ORM\Column(type="string", name="second_field", length=255)
     *
     * @var string
     */
    private $secondField;

    /**
     * @ORM\Column(type="string", name="name", length=255)
     *
     * @var string
     */
    private $name;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="addresses")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user = null;

    public function __construct()
    {
    }

    /**
     * Set User.
     *
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * get User.
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * get city.
     *
     * @city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $postalCode
     *
     * @return Address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * get postalCode.
     *
     * @returnpostalCode
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $firstField
     *
     * @return Address
     */
    public function setFirstField($firstField)
    {
        $this->firstField = $firstField;
    }

    /**
     * get firstField.
     *
     * @returnfirstField
     */
    public function getFirstField()
    {
        return $this->firstField;
    }

    /**
     * @param string $secondField
     *
     * @return Address
     */
    public function setSecondField($secondField)
    {
        $this->secondField = $secondField;
    }

    /**
     * get secondField.
     *
     * @return secondField
     */
    public function getSecondField()
    {
        return $this->secondField;
    }

    /**
     * @param string $name
     *
     * @return Address
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * get name.
     *
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
}
