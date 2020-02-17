<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Entity\Users;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PostsController extends AbstractController
{
    /**
     * @Route("/profile/{userId}/update_post/{postId}",
     * defaults={"newPost":"placeholder"},
     * requirements={
     *     "id": "\d" }
     * )
     */
    public function updatePost(Request $request, $postId, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Posts::class)->findPostById($postId);

        if ($post) {
            $newPost = $request->request->get('newPost');
            $post->setPost($newPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profile', [
            'userId' => $userId
        ]);

    }

    /**
     * @Route("/profile/{userId}/add_post",
     *     defaults={"newPost":"placeholder"},
     *     requirements={
     *          "id": "\d" }
     * )
     */
    public function addNewPost(Request $request, $userId)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Users::class)->findUserById($userId);
        $postText = $request->request->get('newPost');
        $date = new DateTime();
        $newPost = new Posts();
        $newPost->setUser($user);
        $newPost->setPostDate($date);
        $newPost->setPost($postText);
        $entityManager->persist($newPost);
        $entityManager->flush();

        return $this->redirectToRoute('profile', [
            'userId' => $userId
        ]);
    }
}
