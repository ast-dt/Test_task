<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class LoginController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function showStartPage()
    {
        return $this->render('start.html.twig',
            ['message' => null]);
    }

    /**
     * @Route("/user_not_found")
     */
    public function showUserNotFound()
    {
        return $this->render('start.html.twig',
            ['message' => "User not found"]);
    }

    /**
     * @Route("/user_blocked")
     */
    public function showUserBlocked()
    {
        return $this->render('start.html.twig',
            ['message' => "User blocked"]);
    }

    /**
     * @Route("/login",
     *      defaults={"loginName":"placeholder",
     *                "pswd":"placeholder"}
     * )
     */
    public function login(Request $request)
    {
        $login = $request->request->get('loginName');
        $password = $request->request->get('pswd');
        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findUserByLoginAndPassword($login, $password);

        if (!$user) {
            //return $this->redirectToRoute('userNotFound');
            return $this->render('start.html.twig',
                ['message' => $login]);
        }

        if ($user instanceof Users) {
            $isAdmin = $user->getRole()->getIsAdmin();
            if ($isAdmin) {
                return $this->redirectToRoute('administration', [
                    'adminId' => $user->getUserId()]);
            } else {
                $active = $user->getState()->getStateId();
                if ($active == 0) {
                    return $this->redirectToRoute('profile', [
                        'userId' => $user->getUserId()]);
                } else {
                    return $this->redirectToRoute('userBlocked');
                }
            }
        }
    }
}

