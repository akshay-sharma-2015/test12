<?php
namespace TextSetting\Model\Entity;

use Cake\ORM\Entity;

/**
 * TextSetting Entity.
 *
 * @property int $id
 * @property string $language_id
 * @property \TextSetting\Model\Entity\Language $language
 * @property string $msgid
 * @property string $msgstr
 * @property \Cake\I18n\Time $created
 */
class TextSetting extends Entity
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
}
