<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ProfileController extends AbstractController
{
    public function showProfile($userId)
    {
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "SELECT u.user_id, u.login, ui.user_name, ui.user_photo
                    FROM tst.users AS u
                    LEFT JOIN tst.user_info AS ui
                    ON u.user_id=ui.user_id
                    WHERE u.user_id='$userId'";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        }
        $posts[0] = null;
        if ($row = pg_fetch_row($result)) {
            $user = new \User($row[0], $row[1], $row[2], $row[3]);
            $photo = "images/$row[0].png";
            file_put_contents($photo, pg_unescape_bytea($row[3]));
            $url = "../images/$row[0].png";
        } else {
            return $this->redirectToRoute('userNotFound');
        }

        $query = "SELECT post_id, post, post_date FROM tst.posts WHERE user_id='$userId' ORDER BY post_date";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        }
        $posts[0] = null;
        for ($i = 0; $i < pg_num_rows($result); $i++) {
            $row = pg_fetch_row($result);
            $posts[$i] = new \Post($row[0], $row[1], $row[2]);
        }

        return $this->render('user.html.twig', [
            'posts' => $posts,
            'user' => $user,
            'photoUrl' => $url
        ]);
    }

    public function addNewPost()
    {
        $userId = $_GET["userId"];
        $post = $_GET["postText"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "INSERT INTO tst.posts(user_id, post, post_date)
                    VALUES ('$userId','$post',current_timestamp)";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('profile', ['userId' => $userId]);
        }
    }

    public function updatePost()
    {
        $userId = $_POST["userId"];
        $post = $_POST["postText"];
        $postId = $_POST["postId"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "UPDATE tst.posts set post = '$post' WHERE user_id = '$userId' and post_id = '$postId'";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('profile', ['userId' => $userId]);
        }
    }

    public function updateName()
    {
        $userId = $_POST["userId"];
        $userName=$_POST["userName"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "UPDATE tst.user_info set user_name = '$userName' WHERE user_id = '$userId'";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('profile', ['userId' => $userId]);
        }
    }

    public function updatePassword()
    {
        $userId = $_POST["userId"];
        $pswd=$_POST["pswd"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "CALL tst.update_user_password('$userId','$pswd')";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('profile', ['userId' => $userId]);
        }
    }

    public function updatePhoto()
    {
        $userId = $_POST["userId"];
        $photo=pg_escape_bytea(file_get_contents($_FILES["photo"]["tmp_name"]));
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "UPDATE tst.user_info SET user_photo = '$photo' WHERE user_id = '$userId'";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('profile', ['userId' => $userId]);
        }
    }
}