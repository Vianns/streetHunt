<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
 * @Vich\Uploadable
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * Administrator role.
     */
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * Basic role.
     */
    const ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Vich\UploadableField(mapping="user_avatar", fileNameProperty="avatarName")
     *
     * @var File
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $avatarName;

    /**
     * @Vich\UploadableField(mapping="user_picture", fileNameProperty="pictureName")
     *
     * @var File
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $pictureName;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_picture_validated", type="boolean")
     */
    private $pictureValidated = false;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=10, nullable=true)
     */
    protected $sex;

    /**
     * @var Date
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", nullable=true)
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Address", mappedBy="user")
     */
    protected $addresses;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SessionUser", mappedBy="user")
     */
    protected $userSessions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $transports;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    protected $lastName;

    /**
     * @var bool
     *
     * @ORM\Column(name="civil_responsability", type="boolean")
     */
    private $civilResponsability = false;

    public function __construct()
    {
        parent::__construct();
        $this->addresses = new ArrayCollection();
        $this->userSessions = new ArrayCollection();
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * Set the value of id.
     *
     * @param int $id
     *
     * @return \AppBundle\Entity\Project
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setAvatarFile(File $image = null)
    {
        $this->avatarFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setAvatarName($avatarName)
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvatarName()
    {
        return null == $this->avatarName ? 'default.jpg' : $this->avatarName;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setPictureFile(File $image = null)
    {
        $this->pictureFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * @param string $pictureName
     *
     * @return Product
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPictureName()
    {
        return null == $this->pictureName ? 'default.jpg' : $this->pictureName;
    }

    /**
     * Set pictureValidated.
     *
     * @param bool $pictureValidated
     *
     * @return User
     */
    public function setPictureValidated($pictureValidated)
    {
        $this->pictureValidated = $pictureValidated;

        return $this;
    }

    /**
     * Get pictureValidated.
     *
     * @return bool
     */
    public function isPictureValidated()
    {
        return $this->pictureValidated;
    }

    /**
     * Set the value of sex.
     *
     * @param string $sex
     *
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get the value of sex.
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set the value of birthday.
     *
     * @param string $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the value of birthday.
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of phone number.
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the value of phoneNumber.
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Add Challenge.
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return User
     */
    public function addAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address.
     *
     * @param \AppBundle\Entity\Address $address
     */
    public function removeChallenge(\AppBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set the value of transports.
     *
     * @param string $transport
     *
     * @return User
     */
    public function setTransports($transports)
    {
        $this->transports = $transports;

        return $this;
    }

    /**
     * Get the value of transports.
     *
     * @return string
     */
    public function getTransports()
    {
        return $this->transports;
    }

    /**
     * Add UserSession.
     *
     * @param \AppBundle\Entity\SessionUser $userSession
     *
     * @return User
     */
    public function addUserSession(\AppBundle\Entity\SessionUser $userSession)
    {
        $this->userSessions[] = $userSession;

        return $this;
    }

    /**
     * Remove userSession.
     *
     * @param \AppBundle\Entity\SessionUser $userSession
     */
    public function removeUserSession(\AppBundle\Entity\SessionUser $userSession)
    {
        $this->userSessions->removeElement($userSession);
    }

    /**
     * Get userSessions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserSessions()
    {
        return $this->userSessions;
    }

    /**
     * Set the value of firstName.
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstname($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of firstName.
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of lastName.
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of lastName.
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set civilResponsability.
     *
     * @param bool $civilResponsability
     *
     * @return User
     */
    public function setCivilResponsability($civilResponsability)
    {
        $this->civilResponsability = $civilResponsability;

        return $this;
    }

    /**
     * Get civilResponsability.
     *
     * @return bool
     */
    public function hasCivilResponsability()
    {
        return $this->civilResponsability;
    }

    /**
     * Return list of possibles roles.
     *
     * @return array
     */
    public static function getPossibleRoles()
    {
        return [
            self::ROLE_USER => 'user.role.label.user',
            self::ROLE_ADMIN => 'user.role.label.administrator',
        ];
    }

    /**
     * get user cities.
     *
     * @return [type] [description]
     */
    public function getCities()
    {
        $userAddresses = [];
        foreach ($this->getAddresses() as $address) {
            $userAddresses[$address->getCity()] = $address->getCity();
        }

        return $userAddresses;
    }

    public function getLevel()
    {
        return 'level 1';
    }
}
