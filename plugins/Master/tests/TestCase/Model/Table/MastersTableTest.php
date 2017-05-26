<?php
namespace Master\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Master\Model\Table\MastersTable;

/**
 * Master\Model\Table\MastersTable Test Case
 */
class MastersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Master\Model\Table\MastersTable
     */
    public $Masters;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.master.masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Masters') ? [] : ['className' => 'Master\Model\Table\MastersTable'];
        $this->Masters = TableRegistry::get('Masters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Masters);

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
