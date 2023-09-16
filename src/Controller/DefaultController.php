<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Register;
use App\Form\Type\RegisterType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[AsController]
class DefaultController
{
    public function __construct(private readonly Environment $twig, private readonly FormFactoryInterface $form)
    {
    }

    #[Route(path: "/", name: "app_home")]
    public function index(Request $request): Response
    {
        $register = new Register();
        $registrationForm = $this->form->create(RegisterType::class, $register);
        $registrationForm->handleRequest($request);
        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            // do something
            $data = $registrationForm->getData();
        }

        $content = $this->twig->render('index/index.html.twig', ['form' => $registrationForm->createView()]);

        return new Response($content);
    }
}