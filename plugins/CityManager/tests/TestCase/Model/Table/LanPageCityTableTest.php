<?php
namespace CityManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CityManager\Model\Table\LanPageCityTable;

/**
 * CityManager\Model\Table\LanPageCityTable Test Case
 */
class LanPageCityTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CityManager\Model\Table\LanPageCityTable
     */
    public $LanPageCity;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.city_manager.lan_page_city',
        'plugin.city_manager.cities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('LanPageCity') ? [] : ['className' => 'CityManager\Model\Table\LanPageCityTable'];
        $this->LanPageCity = TableRegistry::get('LanPageCity', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->LanPageCity);

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
