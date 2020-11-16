<?php

namespace App\Controller;

use App\Httpclient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Requete;
use App\Form\RequestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, HttpClientInterface $client): Response
    {
        /*
         * Création du formulaire
         */
        $task = new Requete();
        $task->setUrl('');
        $task->setMethod('');
        $task->setToken('');

        $form = $this->createForm(RequestType::class, $task);

        $form->handleRequest($request);

        $query = $this->getDoctrine()
            ->getRepository(Requete::class)
            ->ReturnAllQueries();

        $bool = False;
        /*
         * si le formulaire est valide et envoyé.
         */
        if ($form->isSubmitted() && $form->isValid()) {
            $bool = True;
            $task = $form->getData();


            $url = $task->getUrl();
            $token = $task->getToken();
            $method = $task->getMethod();
            $useRequest = new Httpclient();
            $content = $useRequest->UseRequest($client, $method, $url, $token);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'form' => $form->createView(),
                'contents' => $content->toArray(),
                'bool' => $bool,
                'queries' => $query,
                'token' => $token,
            ]);
        } else {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'form' => $form->createView(),
                'bool' => $bool,
                'queries' => $query,

            ]);
        }
    }
    /*
     * fontction qui appelle le repository pour supprimer les requêtes.
        public function CallDeleteQuerryRepo($id): Response
        {
            var_dump($id);
            $query = $this->getDoctrine()
                ->getRepository(Requete::class)
                ->DeleteQuerry($id);

            return new Response('');
        }
    */
}
