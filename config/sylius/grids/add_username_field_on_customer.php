<?php

declare(strict_types=1);

use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilder;
use Sylius\Bundle\GridBundle\Config\GridConfig;

return static function (GridConfig $gridConfig): void {
    $gridConfig->addGrid(GridBuilder::create('sylius_admin_customer', '%sylius.model.customer.class%')
        ->addField(
            StringField::create('username')
                ->setLabel('sylius.ui.username')
                ->setPath('user.username')
                ->setPosition(0)
        )
    );
};
