<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Artwork;
use FOS\UserBundle\Model\UserInterface;
use http\Env\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $current = 'Impressionisme';
        $em = $this->getDoctrine()->getManager();
        $artworks= $em->getRepository(Artwork::class)->seenArtworksInOneCurrent($user, $current);

        return $this->render('default/index.html.twig', [
            'user' => $user,
            'artworks' => $artworks,
        ]);
    }
}
