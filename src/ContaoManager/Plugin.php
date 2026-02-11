<?php

declare(strict_types=1);

namespace MirandaLeyva\ContaoPopupBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;

final class Plugin implements BundlePluginInterface
{
    public function getBundles(): array
    {
        return [
            (new BundleConfig(\MirandaLeyva\ContaoPopupBundle\MirandaLeyvaContaoPopupBundle::class))
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
