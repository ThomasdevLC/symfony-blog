<?php

namespace App\Controller;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\BlogpostRepository;
use App\Repository\CommentaireRepository;
use App\Repository\PeintureRepository;
use App\Service\CommentaireService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogpostController extends AbstractController
{
    #[Route('/actualites', name: 'actualites')]
    public function actualites(

        BlogpostRepository $blogRepository,
        PaginatorInterface $paginator,
        Request            $request,
    ): Response
    {
        $data = $blogRepository->findBy([],['id' => 'DESC']);

        $blogposts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

        {
            return $this->render('blogpost/actualites.html.twig', [
                'blogposts' => $blogposts,
            ]);
        }
    }

    #[Route('/actualites/{slug}', name: 'actualites_detail')]
    public function details(
        BlogpostRepository $blogpostRepository, string $slug
    ): Response
    {
        $blogpost = $blogpostRepository->findOneBy(['slug' => $slug]);

        if (!$blogpost) {
            throw $this->createNotFoundException('Le post n\'existe pas');
        }

        return $this->render('blogpost/details.html.twig', [
            'blogpost' => $blogpost,
        ]);
    }

    #[Route('/actualites/{slug}', name: 'actualites_detail')]
    public function detail(
        BlogpostRepository $blogpostRepository,
        string $slug,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository
    ): Response
    {
        $blogpost = $blogpostRepository->findOneBy(['slug' => $slug]);

        if (!$blogpost) {
            throw $this->createNotFoundException('Le post n\'existe pas');
        }
        $commentaires = $commentaireRepository->findCommentaires($blogpost);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData(); // Correction ici
            $commentaireService->persistCommentaire($commentaire, $blogpost, null);

            return $this->redirectToRoute('actualites_detail', ['slug' => $blogpost->getSlug()]);
        }

        return $this->render('blogpost/details.html.twig', [
            'blogpost' => $blogpost,
            'form' => $form->createView(),
            'commentaires' => $commentaires,
        ]);
    }

}