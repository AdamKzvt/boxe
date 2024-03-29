<?php

namespace App\Controller;


use App\Entity\Article;
use App\Entity\Commentaires;
use App\Form\ArticleType;
use App\Form\CommentairesType;
use App\Repository\ArticleRepository;
use App\Repository\CommentairesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }
    

    #[Route('/new', name: 'app_article_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = new Article();
        $article->setUser($this->getUser());
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article, true);

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_show', methods: ['GET', 'POST'])]
    public function show(Article $article, Request $request, CommentairesRepository $commentairesRepository, $id): Response
    {  

        $commentaire = new Commentaires();
        $commentaire->setUser($this->getUser());
        $commentaire->setArticle($article);
        $commentform = $this->createForm(CommentairesType::class, $commentaire);
        $commentform->handleRequest($request);

        if ($commentform->isSubmitted() && $commentform->isValid()){
            $commentairesRepository->save($commentaire, true);

            return $this->redirectToRoute('app_article_show', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        if ($this->isCsrfTokenValid('delete'.$commentaire->getId(), $request->request->get('_token'))) {
            $commentairesRepository->remove($commentaire, true);
        }
    return $this->render('article/show.html.twig', [
        'article' => $article,
        'commentaire' => $commentaire,
        'commentForm'=>$commentform->createView()
    ]);   
    }
    

    #[Route('/{id}/edit', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article, true);

            return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

#[Route('/{id}/delete', name: 'app_article_delete', methods: ['POST'])]
public function delete(Request $request, Article $article, ArticleRepository $articleRepository, CommentairesRepository $commentairesRepository): Response
{
    if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
        // Obtenir les commentaires associés à l'article.
        $arrCom = $article->getCommentaires();
        // Pour chaque commentaire trouvé, supprimez-le.
        foreach($arrCom as $com){
            $commentairesRepository->remove($com);
        }
        $articleRepository->remove($article, true);
    }

    return $this->redirectToRoute('app_article_index', [], Response::HTTP_SEE_OTHER);
}
}
