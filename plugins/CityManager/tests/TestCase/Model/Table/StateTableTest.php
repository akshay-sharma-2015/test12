<?php
namespace CityManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CityManager\Model\Table\StateTable;

/**
 * CityManager\Model\Table\StateTable Test Case
 */
class StateTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CityManager\Model\Table\StateTable
     */
    public $State;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.city_manager.state',
        'plugin.city_manager.countries',
        'plugin.city_manager.city'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('State') ? [] : ['className' => 'CityManager\Model\Table\StateTable'];
        $this->State = TableRegistry::get('State', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->State);

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
