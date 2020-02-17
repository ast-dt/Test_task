<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{userId}",
     *      requirements={"userId":"\d+"}
     *)
     */
    public function showProfile($userId)
    {
        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findUserById($userId);

        if ($user) {
            $posts = $this->getDoctrine()
                ->getRepository(Posts::class)
                ->findPostsByUser($userId);

            $photo = $user->getUserPhoto();
            $photoContent = stream_get_contents($photo);
            $encodedPhoto = $base64Data = base64_encode(pg_unescape_bytea($photoContent));

            return $this->render('user.html.twig', [
                'posts' => $posts,
                'user' => $user,
                'photo' => $encodedPhoto
            ]);
        } else {
            return $this->redirectToRoute('userNotFound');
        }
    }
}