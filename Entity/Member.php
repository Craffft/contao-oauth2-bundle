<?php

/*
 * This file is part of the Craffft OAuth2 Bundle.
 *
 * (c) Daniel Kiesel <https://github.com/iCodr8>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Craffft\ContaoOAuth2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Member
 *
 * @ORM\Table(
 *     name="tl_member",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="autologin", columns={"autologin"}),
 *         @ORM\UniqueConstraint(name="username", columns={"username"})
 *     },
 *     indexes={
 *         @ORM\Index(name="email", columns={"email"}),
 *         @ORM\Index(name="activation", columns={"activation"})
 *     }
 * )
 * @ORM\Entity(repositoryClass="Craffft\ContaoOAuth2Bundle\Repository\MemberRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Member implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer", options={"unsigned" = true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, options={"default"=0, "unsigned"=true})
     */
    private $tstamp = '0';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false, options={"default"=""})
     */
    private $firstname = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false, options={"default"=""})
     */
    private $lastname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="dateOfBirth", type="string", length=11, nullable=false, options={"default"=""})
     */
    private $dateOfBirth = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false, options={"default"=""})
     */
    private $gender = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false, options={"default"=""})
     */
    private $company = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false, options={"default"=""})
     */
    private $street = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false, options={"default"=""})
     */
    private $postal = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false, options={"default"=""})
     */
    private $city = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=false, options={"default"=""})
     */
    private $state = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=2, nullable=false, options={"default"=""})
     */
    private $country = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=false, options={"default"=""})
     */
    private $phone = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=false, options={"default"=""})
     */
    private $mobile = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=false, options={"default"=""})
     */
    private $fax = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false, options={"default"=""})
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false, options={"default"=""})
     */
    private $website = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=false, options={"default"=""})
     */
    private $language = '';

    /**
     * @var boolean
     *
     * @ORM\Column(type="array", columnDefinition="blob NULL")
     */
    private $groups = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=false, options={"default"="", "fixed"=true})
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=false, options={"default"=""})
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="assignDir", type="string", length=1, nullable=false, options={"default"="", "fixed"=true})
     */
    private $assignDir = '';

    /**
     * @var binary
     *
     * @ORM\Column(name="homeDir", type="binary", length=16, nullable=true, options={"fixed"=true})
     */
    private $homeDir = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1, nullable=false, options={"default"="", "fixed"=true})
     */
    private $disable = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=false, options={"default"=""})
     */
    private $start = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=false, options={"default"=""})
     */
    private $stop = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="dateAdded", type="integer", nullable=false, options={"default"=0, "unsigned"=true})
     */
    private $dateAdded = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lastLogin", type="integer", nullable=false, options={"default"=0, "unsigned"=true})
     */
    private $lastLogin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="currentLogin", type="integer", nullable=false, options={"default"=0, "unsigned"=true})
     */
    private $currentLogin = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="loginCount", type="smallint", nullable=false, options={"default"=3, "unsigned"=true})
     */
    private $loginCount = '3';

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, options={"default"=0, "unsigned"=true})
     */
    private $locked = '0';

    /**
     * @var string
     *
     * @ORM\Column(type="blob", length=65535, nullable=true)
     */
    private $session;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $autologin;

    /**
     * @var integer
     *
     * @ORM\Column(name="createdOn", type="integer", nullable=false, options={"default"=0, "unsigned"=true})
     */
    private $createdOn = '0';

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false, options={"default"=""})
     */
    private $activation = '';


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
     * Set tstamp
     *
     * @param integer $tstamp
     *
     * @return Member
     */
    public function setTstamp($tstamp)
    {
        $this->tstamp = $tstamp;

        return $this;
    }

    /**
     * Get tstamp
     *
     * @return integer
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Member
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Member
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dateOfBirth
     *
     * @param string $dateOfBirth
     *
     * @return Member
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Member
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
     * Set company
     *
     * @param string $company
     *
     * @return Member
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Member
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set postal
     *
     * @param string $postal
     *
     * @return Member
     */
    public function setPostal($postal)
    {
        $this->postal = $postal;

        return $this;
    }

    /**
     * Get postal
     *
     * @return string
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Member
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
     * Set state
     *
     * @param string $state
     *
     * @return Member
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Member
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Member
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return Member
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Member
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Member
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
     * Set website
     *
     * @param string $website
     *
     * @return Member
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return Member
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set groups
     *
     * @param boolean $groups
     *
     * @return Member
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return boolean
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Member
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Member
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Member
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
     * Set assignDir
     *
     * @param string $assignDir
     *
     * @return Member
     */
    public function setAssignDir($assignDir)
    {
        $this->assignDir = $assignDir;

        return $this;
    }

    /**
     * Get assignDir
     *
     * @return string
     */
    public function getAssignDir()
    {
        return $this->assignDir;
    }

    /**
     * Set homeDir
     *
     * @param binary $homeDir
     *
     * @return Member
     */
    public function setHomeDir($homeDir)
    {
        $this->homeDir = $homeDir;

        return $this;
    }

    /**
     * Get homeDir
     *
     * @return binary
     */
    public function getHomeDir()
    {
        return $this->homeDir;
    }

    /**
     * Set disable
     *
     * @param string $disable
     *
     * @return Member
     */
    public function setDisable($disable)
    {
        $this->disable = $disable;

        return $this;
    }

    /**
     * Get disable
     *
     * @return string
     */
    public function getDisable()
    {
        return $this->disable;
    }

    /**
     * Set start
     *
     * @param string $start
     *
     * @return Member
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set stop
     *
     * @param string $stop
     *
     * @return Member
     */
    public function setStop($stop)
    {
        $this->stop = $stop;

        return $this;
    }

    /**
     * Get stop
     *
     * @return string
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * Set dateAdded
     *
     * @param integer $dateAdded
     *
     * @return Member
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return integer
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set lastLogin
     *
     * @param integer $lastLogin
     *
     * @return Member
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return integer
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set currentLogin
     *
     * @param integer $currentLogin
     *
     * @return Member
     */
    public function setCurrentLogin($currentLogin)
    {
        $this->currentLogin = $currentLogin;

        return $this;
    }

    /**
     * Get currentLogin
     *
     * @return integer
     */
    public function getCurrentLogin()
    {
        return $this->currentLogin;
    }

    /**
     * Set loginCount
     *
     * @param integer $loginCount
     *
     * @return Member
     */
    public function setLoginCount($loginCount)
    {
        $this->loginCount = $loginCount;

        return $this;
    }

    /**
     * Get loginCount
     *
     * @return integer
     */
    public function getLoginCount()
    {
        return $this->loginCount;
    }

    /**
     * Set locked
     *
     * @param integer $locked
     *
     * @return Member
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return integer
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set session
     *
     * @param string $session
     *
     * @return Member
     */
    public function setSession($session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return string
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set autologin
     *
     * @param string $autologin
     *
     * @return Member
     */
    public function setAutologin($autologin)
    {
        $this->autologin = $autologin;

        return $this;
    }

    /**
     * Get autologin
     *
     * @return string
     */
    public function getAutologin()
    {
        return $this->autologin;
    }

    /**
     * Set createdOn
     *
     * @param integer $createdOn
     *
     * @return Member
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return integer
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set activation
     *
     * @param string $activation
     *
     * @return Member
     */
    public function setActivation($activation)
    {
        $this->activation = $activation;

        return $this;
    }

    /**
     * Get activation
     *
     * @return string
     */
    public function getActivation()
    {
        return $this->activation;
    }


    /**
     * @return array
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return void
     */
    public function eraseCredentials()
    {

    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->tstamp,
            $this->firstname,
            $this->lastname,
            $this->dateOfBirth,
            $this->gender,
            $this->company,
            $this->street,
            $this->postal,
            $this->city,
            $this->state,
            $this->country,
            $this->phone,
            $this->mobile,
            $this->fax,
            $this->email,
            $this->website,
            $this->language,
            $this->groups,
            $this->login,
            $this->username,
            $this->password,
            $this->assignDir,
            $this->homeDir,
            $this->disable,
            $this->start,
            $this->stop,
            $this->dateAdded,
            $this->lastLogin,
            $this->currentLogin,
            $this->loginCount,
            $this->locked,
            $this->session,
            $this->autologin,
            $this->createdOn,
            $this->activation
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->tstamp,
            $this->firstname,
            $this->lastname,
            $this->dateOfBirth,
            $this->gender,
            $this->company,
            $this->street,
            $this->postal,
            $this->city,
            $this->state,
            $this->country,
            $this->phone,
            $this->mobile,
            $this->fax,
            $this->email,
            $this->website,
            $this->language,
            $this->groups,
            $this->login,
            $this->username,
            $this->password,
            $this->assignDir,
            $this->homeDir,
            $this->disable,
            $this->start,
            $this->stop,
            $this->dateAdded,
            $this->lastLogin,
            $this->currentLogin,
            $this->loginCount,
            $this->locked,
            $this->session,
            $this->autologin,
            $this->createdOn,
            $this->activation
            ) = unserialize($serialized);
    }
}
