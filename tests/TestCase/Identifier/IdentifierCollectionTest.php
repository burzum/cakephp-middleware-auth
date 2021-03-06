<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         4.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Auth\Test\TestCase\Identifier;

use Authentication\Identifier\IdentifierCollection;
use Authentication\Test\TestCase\AuthenticationTestCase as TestCase;

class IdentifierCollectionTest extends TestCase
{

    public function testConstruct()
    {
        $collection = new IdentifierCollection([
            'Authentication.Orm'
        ]);
        $result = $collection->get('Authentication.Orm');
        $this->assertInstanceOf('\Authentication\Identifier\OrmIdentifier', $result);
    }

    /**
     * testLoad
     *
     * @return void
     */
    public function testLoad()
    {
        $collection = new IdentifierCollection();
        $result = $collection->load('Authentication.Orm');
        $this->assertInstanceOf('\Authentication\Identifier\OrmIdentifier', $result);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testLoadException()
    {
        $collection = new IdentifierCollection();
        $collection->load('Does-not-exist');
    }

    /**
     * testGetAll
     *
     * @return void
     */
    public function testGetAll()
    {
        $collection = new IdentifierCollection();
        $collection->load('Authentication.Orm');
        $result = $collection->getAll();
        $this->assertInternalType('array', $result);
    }

    /**
     * testIdentify
     *
     * @return void
     */
    public function testIdentify()
    {
        $collection = new IdentifierCollection([
            'Authentication.Orm'
        ]);

        $result = $collection->identify([
            'username' => 'mariano',
            'password' => 'password'
        ]);

        $this->assertInstanceOf('\Cake\Datasource\EntityInterface', $result);
    }
}
