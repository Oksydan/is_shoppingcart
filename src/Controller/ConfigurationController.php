<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Controller;

use Oksydan\IsShoppingcart\Translations\TranslationDomains;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigurationController extends FrameworkBundleAdminController
{
    public function index(): Response
    {
        $formHandler = $this->get('oksydan.is_shoppingcart.configuration.form_handler');
        $form = $formHandler->getForm();

        return $this->render('@Modules/is_shoppingcart/views/templates/admin/index.html.twig', [
            'translationDomain' => TranslationDomains::TRANSLATION_DOMAIN_ADMIN,
            'configurationForm' => $form->createView(),
            'help_link' => false,
        ]);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function saveConfiguration(Request $request): Response
    {
        $redirectResponse = $this->redirectToRoute('is_shoppingcart_controller');

        $formHandler = $this->get('oksydan.is_shoppingcart.configuration.form_handler');
        $form = $formHandler->getForm();

        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return $redirectResponse;
        }

        if ($form->isValid()) {
            $data = $form->getData();
            $saveErrors = $formHandler->save($data);

            if (!$saveErrors || 0 === count($saveErrors)) {
                $this->addFlash('success', $this->trans('Successful update.', 'Admin.Notifications.Success'));

                return $redirectResponse;
            }
        }

        $formErrors = [];

        foreach ($form->getErrors(true) as $error) {
            $formErrors[] = $error->getMessage();
        }

        $this->flashErrors($formErrors);

        return $redirectResponse;
    }
}
