<?php
namespace CityManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use CityManager\Model\Table\ContinentsTable;

/**
 * CityManager\Model\Table\ContinentsTable Test Case
 */
class ContinentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \CityManager\Model\Table\ContinentsTable
     */
    public $Continents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.city_manager.continents',
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
        $config = TableRegistry::exists('Continents') ? [] : ['className' => 'CityManager\Model\Table\ContinentsTable'];
        $this->Continents = TableRegistry::get('Continents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Continents);

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
