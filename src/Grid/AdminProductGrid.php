<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\Product\Product;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class AdminProductGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'sylius_admin_product';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->orderBy('createdAt', 'desc')
            ->addField(StringField::create('name')
                ->setLabel('sylius.ui.name')
                ->setSortable(true)
            )
            ->addField(TwigField::create('enabled', '@SyliusUi/Grid/Field/enabled.html.twig')
                ->setLabel('sylius.ui.enabled')
            )
            ->addField(DateTimeField::create('createdAt')
                ->setLabel('sylius.ui.creation_date')
                ->setSortable(true)
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                )
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    ShowAction::create(),
                    UpdateAction::create(),
                    DeleteAction::create(),
                )
            )
        ;
    }

    public static function getResourceClass(): string
    {
        return Product::class;
    }
}
