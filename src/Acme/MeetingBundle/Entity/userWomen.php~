<?php
namespace Acme\MeetingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="userWomen")
 */
class UserWomen
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
     * @ORM\Column(type="string", length=2)
     */
    protected $breast;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $waist;

    /**
     * @ORM\Column(type="string", length=3)
     */
    protected $Hips;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $image;

    public $file;

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
     * @return userWomen
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
     * @return userWomen
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
     * @return userWomen
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
     * @return userWomen
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
     * @return userWomen
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
     * @return userWomen
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
     * @return userWomen
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
     * @return userWomen
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
     * @return userWomen
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
     * Set breast
     *
     * @param string $breast
     * @return userWomen
     */
    public function setBreast($breast)
    {
        $this->breast = $breast;

        return $this;
    }

    /**
     * Get breast
     *
     * @return string
     */
    public function getBreast()
    {
        return $this->breast;
    }

    /**
     * Set waist
     *
     * @param string $waist
     * @return userWomen
     */
    public function setWaist($waist)
    {
        $this->waist = $waist;

        return $this;
    }

    /**
     * Get waist
     *
     * @return string
     */
    public function getWaist()
    {
        return $this->waist;
    }

    /**
     * Set Hips
     *
     * @param string $hips
     * @return userWomen
     */
    public function setHips($hips)
    {
        $this->Hips = $hips;

        return $this;
    }

    /**
     * Get Hips
     *
     * @return string
     */
    public function getHips()
    {
        return $this->Hips;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return userWomen
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

    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/documents';
    }

    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        $this->setImage($this->file->getClientOriginalName());

        $this->file = null;
    }
}
