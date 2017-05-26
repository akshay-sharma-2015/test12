<?php
namespace CityManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CityManager\Model\Table\CityTable;

/**
 * CityManager\Model\Table\CityTable Test Case
 */
class CityTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CityManager\Model\Table\CityTable
     */
    public $City;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.city_manager.city',
        'plugin.city_manager.states',
        'plugin.city_manager.countries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('City') ? [] : ['className' => 'CityManager\Model\Table\CityTable'];
        $this->City = TableRegistry::get('City', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->City);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
