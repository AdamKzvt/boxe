<?php

namespace App\Controller;

use App\Repository\LicenceRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository, LicenceRepository $licenceRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findBy([], ['id' => 'DESC']),
            'licences' => $licenceRepository->findAll(),
        ]);
    }
}