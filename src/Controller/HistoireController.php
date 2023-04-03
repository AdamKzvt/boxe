<?php

namespace App\Controller;

use App\Repository\BoxeurRepository;
use App\Repository\StaffRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoireController extends AbstractController
{
    #[Route('/histoire', name: 'app_histoire')]
    public function index(StaffRepository $staffRepository, BoxeurRepository $boxeurRepository): Response
    {
        return $this->render('histoire/index.html.twig', [
            'controller_name' => 'HistoireController',
            'staff'=>$staffRepository->findAll(),
            'boxeurs'=>$boxeurRepository->findAll(),
            
        ]);
    }
}
