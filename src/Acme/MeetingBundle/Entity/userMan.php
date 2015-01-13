<?php
namespace Acme\MeetingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="userMan")
 */
class UserMan
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $gender;

    /**
     * @ORM\Column(type="string", length=70)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $FirstName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $LastName;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $city;

    /**
     * @ORM\Column(type="date")
     */
    protected $BirthDate;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $MaritalStatus;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $BodyType;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $image;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set FirstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->FirstName = $firstName;

        return $this;
    }

    /**
     * Get FirstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * Set LastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->LastName = $lastName;

        return $this;
    }

    /**
     * Get LastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->LastName;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set BirthDate
     *
     * @param \DateTime $birthDate
     * @return User
     */
    public function setBirthDate($birthDate)
    {
        $this->BirthDate = $birthDate;

        return $this;
    }

    /**
     * Get BirthDate
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->BirthDate;
    }

    /**
     * Set MaritalStatus
     *
     * @param string $maritalStatus
     * @return User
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->MaritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get MaritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->MaritalStatus;
    }

    /**
     * Set BodyType
     *
     * @param string $bodyType
     * @return User
     */
    public function setBodyType($bodyType)
    {
        $this->BodyType = $bodyType;

        return $this;
    }

    /**
     * Get BodyType
     *
     * @return string
     */
    public function getBodyType()
    {
        return $this->BodyType;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
