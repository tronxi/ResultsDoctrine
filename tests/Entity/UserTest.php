<?php

/**
 * PHP version 7.4
 * tests/Entity/UserTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package MiW\Results\Tests\Entity
 * @group   users
 */
class UserTest extends TestCase
{
    /**
     * @var User $user
     */
    private $user;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->user = new User();
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     */
    public function testConstructor(): void
    {
        self::assertNotNull($this->user, "El usuario no es null");
    }

    /**
     * @covers \MiW\Results\Entity\User::getId()
     */
    public function testGetId(): void
    {
        self::assertEquals(0, $this->user->getId(), "Id=0 es igual a " . $this->user->getId());
    }

    /**
     * @covers \MiW\Results\Entity\User::setUsername()
     * @covers \MiW\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername(): void
    {
        $username = "sergio";
        $this->user->setUsername($username);
        self::assertEquals($username, $this->user->getUsername(), "Username= " . $username . " es igual a " . $this->user->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail(): void
    {
        $email = "sergio";
        $this->user->setEmail($email);
        self::assertEquals($email, $this->user->getEmail(), "Email= " . $email . " es igual a " . $this->user->getEmail());
    }

    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled(): void
    {
        $enabled = true;
        $this->user->setEnabled($enabled);
        self::assertEquals($enabled, $this->user->isEnabled(), "Enabled= " . $enabled . " es igual a " . $this->user->isEnabled());
    }

    /**
     * @covers \MiW\Results\Entity\User::setIsAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin
     */
    public function testIsSetAdmin(): void
    {
        $admin = true;
        $this->user->setIsAdmin($admin);
        self::assertEquals($admin, $this->user->isAdmin(), "Admin= " . $admin . " es igual a " . $this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testSetValidatePassword(): void
    {
        $password = "pass";
        $this->user->setPassword($password);
        self::assertTrue($this->user->validatePassword($password), "Password= " . $password . " is validated");
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString(): void
    {
        $toString = sprintf(
            '%3d - %20s - %30s - %1d - %1d',
            $this->user->getId(),
            utf8_encode($this->user->getUsername()),
            utf8_encode($this->user->getEmail()),
            $this->user->isEnabled(),
            $this->user->isAdmin()
        );
        self::assertEquals($toString, $this->user, "To string are equals");
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize(): void
    {
        $array = array(
            'id'            => $this->user->getId(),
            'username'      => utf8_encode($this->user->getUsername()),
            'email'         => utf8_encode($this->user->getEmail()),
            'enabled'       => $this->user->isEnabled(),
            'admin'         => $this->user->isAdmin()
        );
        self::assertEquals(json_encode($array), json_encode($this->user), "json is ok");
    }
}
