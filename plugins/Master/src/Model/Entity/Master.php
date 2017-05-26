<?php
namespace Master\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\Behavior\Translate\TranslateTrait;

/**
 * Master Entity.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property bool $is_active
 * @property bool $is_deleted
 * @property int $parent_id
 * @property \Master\Model\Entity\ParentMaster $parent_master
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Master\Model\Entity\ChildMaster[] $child_masters
 */
class Master extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
	
	use TranslateTrait;
}
