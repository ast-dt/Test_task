<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use User;


class AdministrationController extends AbstractController
{
    /**
     * @Route("administration/{adminId}")
     */
    public function showAdminPage($adminId)
    {
        $users = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findActiveUsers();

        return $this->render('admin.html.twig', [
            'users' => $users,
            'adminId' => $adminId
        ]);
    }
}