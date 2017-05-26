<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Country'), ['action' => 'edit', $country->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Country'), ['action' => 'delete', $country->id], ['confirm' => __('Are you sure you want to delete # {0}?', $country->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Country'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List City'), ['controller' => 'City', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'City', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List State'), ['controller' => 'State', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'State', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="country view large-9 medium-8 columns content">
    <h3><?= h($country->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($country->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($country->code) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($country->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related City') ?></h4>
        <?php if (!empty($country->city)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('State Id') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Code') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($country->city as $city): ?>
            <tr>
                <td><?= h($city->id) ?></td>
                <td><?= h($city->name) ?></td>
                <td><?= h($city->state_id) ?></td>
                <td><?= h($city->country_id) ?></td>
                <td><?= h($city->code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'City', 'action' => 'view', $city->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'City', 'action' => 'edit', $city->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'City', 'action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related State') ?></h4>
        <?php if (!empty($country->state)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Country Id') ?></th>
                <th><?= __('Code') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($country->state as $state): ?>
            <tr>
                <td><?= h($state->id) ?></td>
                <td><?= h($state->name) ?></td>
                <td><?= h($state->country_id) ?></td>
                <td><?= h($state->code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'State', 'action' => 'view', $state->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'State', 'action' => 'edit', $state->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'State', 'action' => 'delete', $state->id], ['confirm' => __('Are you sure you want to delete # {0}?', $state->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
