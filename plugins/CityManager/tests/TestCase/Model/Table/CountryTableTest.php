<?php
namespace CityManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CityManager\Model\Table\CountryTable;

/**
 * CityManager\Model\Table\CountryTable Test Case
 */
class CountryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CityManager\Model\Table\CountryTable
     */
    public $Country;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.city_manager.country',
        'plugin.city_manager.city',
        'plugin.city_manager.state'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Country') ? [] : ['className' => 'CityManager\Model\Table\CountryTable'];
        $this->Country = TableRegistry::get('Country', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Country);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
