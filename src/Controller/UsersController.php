<?php

namespace App\Controller;

use App\Entity\Roles;
use App\Entity\StateList;
use App\Entity\Users;
use Couchbase\Document;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UsersController extends AbstractController
{
    /**
     * @Route("/profile/{userId}/update_password")
     */
    public function updatePassword(Request $request, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findUserById($userId);

        if ($user) {
            $pswd = $request->request->get('password');
            $user->setPswd($pswd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profile', [
            'userId' => $userId
        ]);
    }

    /**
     * @Route("/administration/{adminId}/change_password/{userId}")
     */
    public function updateUserPassword(Request $request, $adminId, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findUserById($userId);

        if ($user) {
            $pswd = $request->request->get('password');
            $user->setPswd($pswd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administration', [
            'adminId' => $adminId
        ]);
    }

    /**
     * @Route("/profile/{userId}/update_name")
     */
    public function updateName(Request $request, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findUserById($userId);

        if ($user) {
            $newName = $request->request->get('userName');
            $user->setUserName($newName);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profile', [
            'userId' => $userId
        ]);
    }

    /**
     * @Route("/administration/{adminId}/change_user_name/{userId}")
     */
    public function updateUserName(Request $request, $adminId, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findUserById($userId);

        if ($user) {
            $newName = $request->request->get('userName');
            $user->setUserName($newName);
            $entityManager->flush();
        }

        return $this->redirectToRoute('administration', [
            'adminId' => $adminId
        ]);
    }

    /**
     * @Route("/profile/{userId}/update_photo")
     */
    public function updatePhoto(Request $request, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findUserById($userId);

        if ($user) {
            $tmpPhoto = $request->files->get('photo');
            if ($tmpPhoto) {
                $filePath = $tmpPhoto->getRealPath();
                $photoContent = pg_escape_bytea(file_get_contents($filePath));
                $user->setUserPhoto($photoContent);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('profile', [
            'userId' => $userId
        ]);
    }

    /**
     * @Route("/administration/{adminId}/delete_user/{userId}")
     */
    public function removeUser($adminId, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findUserById($userId);
        $state = $entityManager->getRepository(StateList::class)->findInactiveState();
        $user->setState($state);
        $entityManager->flush();

        return $this->redirectToRoute('administration', [
            'adminId' => $adminId
        ]);
    }

    /**
     * @Route("/administration/{adminId}/new_user")
     */
    public function addNewUser(Request $request, $adminId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $loginName = $request->request->get('login');
        $userName = $request->request->get('userName');
        $password= $request->request->get('password');

        $role = $entityManager->getRepository(Roles::class)->findUserRole();
        $state = $entityManager->getRepository(StateList::class)->findActiveState();

        $newUser = new Users();
        $newUser->setLogin($loginName);
        $newUser->setUserName($userName);
        $newUser->setRole($role);
        $newUser->setState($state);
        $newUser->setPswd($password);
        $entityManager->persist($newUser);
        $entityManager->flush();

        return $this->redirectToRoute('administration', [
            'adminId' => $adminId
        ]);
    }
}