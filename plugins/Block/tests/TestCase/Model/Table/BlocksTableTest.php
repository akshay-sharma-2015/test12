<?php
namespace Block\Test\TestCase\Model\Table;

use Block\Model\Table\BlocksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Block\Model\Table\BlocksTable Test Case
 */
class BlocksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Block\Model\Table\BlocksTable
     */
    public $Blocks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.block.blocks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Blocks') ? [] : ['className' => 'Block\Model\Table\BlocksTable'];
        $this->Blocks = TableRegistry::get('Blocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Blocks);

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
