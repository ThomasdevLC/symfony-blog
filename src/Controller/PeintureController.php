<?php

namespace App\Controller;

use App\Repository\PeintureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PeintureController extends AbstractController
{
    #[Route('/realisations', name: 'realisations')]
    public function realisations(
        PeintureRepository $peintureRepository,
        PaginatorInterface $paginator,
        Request            $request,

    ): Response
    {
        $data = $peintureRepository->findBy([],['id' => 'DESC']);

        $peintures = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
        {
            return $this->render('peinture/realisations.html.twig', [
                'peintures' => $peintures,
            ]);
        }
    }

    #[Route('/realisations/{slug}', name: 'realisation_details')]
    public function details(
        PeintureRepository $peintureRepository, string $slug
    ): Response
    {
        $peinture = $peintureRepository->findOneBy(['slug' => $slug]);

        if (!$peinture) {
            throw $this->createNotFoundException('La peinture n\'existe pas');
        }

        return $this->render('peinture/details.html.twig', [
            'peinture' => $peinture,
        ]);
    }
}
