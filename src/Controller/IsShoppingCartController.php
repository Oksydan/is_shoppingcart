<?php

declare(strict_types=1);

namespace Oksydan\IsShoppingcart\Controller;

use Oksydan\IsShoppingcart\Translations\TranslationDomains;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IsShoppingCartController extends FrameworkBundleAdminController
{
    public function index(): Response
    {
        $configurationForm = $this->get('oksydan.is_shoppingcart.configuration.form_handler')->getForm();

        return $this->render('@Modules/is_shoppingcart/views/templates/admin/index.html.twig', [
            'translationDomain' => TranslationDomains::TRANSLATION_DOMAIN_ADMIN,
            'configurationForm' => $configurationForm->createView(),
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

        $form = $this->get('oksydan.is_shoppingcart.configuration.form_handler')->getForm();
        $form->handleRequest($request);

        if (!$form->isSubmitted()) {
            return $redirectResponse;
        }

        if ($form->isValid()) {
            $data = $form->getData();
            $saveErrors = $this->get('oksydan.is_shoppingcart.configuration.form_handler')->save($data);

            if (0 === count($saveErrors)) {
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
