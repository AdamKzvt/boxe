<?php

namespace App\Controller;

use App\Repository\LicenceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(LicenceRepository $licenceRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'licences' => $licenceRepository->findAll(),
        ]);
    }
}   