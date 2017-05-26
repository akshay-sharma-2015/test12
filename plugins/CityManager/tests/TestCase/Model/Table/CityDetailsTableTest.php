<?php
namespace CityManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CityManager\Model\Table\CityDetailsTable;

/**
 * CityManager\Model\Table\CityDetailsTable Test Case
 */
class CityDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CityManager\Model\Table\CityDetailsTable
     */
    public $CityDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.city_manager.city_details',
        'plugin.city_manager.cities',
        'plugin.city_manager.objects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CityDetails') ? [] : ['className' => 'CityManager\Model\Table\CityDetailsTable'];
        $this->CityDetails = TableRegistry::get('CityDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CityDetails);

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
