<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            // dd($this->getUser());

            // DEPENDING ON THE ROLE:
            $role = $this->getUser()->getRoles()[0];
            $userId = $this->getUser()->getId();

            if ($role === 'ROLE_ADMIN')
            {
                // CONNEXION FROM ADMIN
                return $this->redirectToRoute('admin');
            } else {
                // CONNEXION FROM A USER -> GO TO BOOKING PAGE
                return $this->redirectToRoute('app_booking_user', array('id' => $userId) );
            } 
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
