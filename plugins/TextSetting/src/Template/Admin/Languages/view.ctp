<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Language'), ['action' => 'edit', $language->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Language'), ['action' => 'delete', $language->id], ['confirm' => __('Are you sure you want to delete # {0}?', $language->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Languages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Language'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Text Settings'), ['controller' => 'TextSettings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Text Setting'), ['controller' => 'TextSettings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="languages view large-9 medium-8 columns content">
    <h3><?= h($language->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($language->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($language->code) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($language->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Text Settings') ?></h4>
        <?php if (!empty($language->text_settings)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Language Id') ?></th>
                <th><?= __('Msgid') ?></th>
                <th><?= __('Msgstr') ?></th>
                <th><?= __('Created') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($language->text_settings as $textSettings): ?>
            <tr>
                <td><?= h($textSettings->id) ?></td>
                <td><?= h($textSettings->language_id) ?></td>
                <td><?= h($textSettings->msgid) ?></td>
                <td><?= h($textSettings->msgstr) ?></td>
                <td><?= h($textSettings->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TextSettings', 'action' => 'view', $textSettings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TextSettings', 'action' => 'edit', $textSettings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TextSettings', 'action' => 'delete', $textSettings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $textSettings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
