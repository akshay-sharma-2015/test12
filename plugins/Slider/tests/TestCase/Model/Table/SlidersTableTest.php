<?php
namespace Slider\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Slider\Model\Table\SlidersTable;

/**
 * Slider\Model\Table\SlidersTable Test Case
 */
class SlidersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Slider\Model\Table\SlidersTable
     */
    public $Sliders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.slider.sliders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sliders') ? [] : ['className' => 'Slider\Model\Table\SlidersTable'];
        $this->Sliders = TableRegistry::get('Sliders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sliders);

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
