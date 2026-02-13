<?php

declare(strict_types=1);

namespace MirandaLeyva\ContaoPopupBundle\Controller;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\InsertTag\InsertTagParser;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(
    category: 'miscellaneous',
    type: 'ml_popup',
    template: 'mod_popup'
)]
final class PopUpModuleController extends AbstractFrontendModuleController
{
    public function __construct(
        private readonly InsertTagParser $insertTagParser,
    ) {}

    protected function getResponse(Template $template, ModuleModel $model, Request $request): Response
    {
        // Assets laden
        $GLOBALS['TL_CSS'][] = 'bundles/mirandaleyvacontaopopup/popup.css|static';
        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/mirandaleyvacontaopopup/popup.js|static';

        $articleId = (int) $model->ml_popup_article;
        $delay = (int) $model->ml_popup_delay;
        $cookieName = (string) ($model->ml_popup_cookie_name ?: 'ml_popup_seen');
        $cookieDays = (int) ($model->ml_popup_cookie_days ?: 30);

        // Artikel rendern
        $template->contentHtml = $this->insertTagParser->replace('{{insert_article::' . $articleId . '}}');
        $template->delaySeconds = max(0, $delay);
        $template->cookieName = $cookieName;
        $template->cookieDays = max(0, $cookieDays);

        return $template->getResponse();
    }
}
