<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use User;


class AdministrationController extends AbstractController
{
    public function showAdminPage($adminId)
    {
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "SELECT user_id, login, user_name, is_admin FROM tst.get_users_info()";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $signUpErrorPage = $this->redirectToRoute('bdError');
        }
        $users[0] = null;
        for ($i = 0; $i < pg_num_rows($result); $i++) {
            $row = pg_fetch_row($result);
            $users[$i] = new User($row[0], $row[1], $row[2], null);
        }
        return $this->render('admin.html.twig', [
            'users' => $users,
            'adminId' => $adminId
        ]);
    }

    public function updateUserName()
    {
        $userId = $_POST["userId"];
        $userName = $_POST["userName"];
        $adminId = $_POST["adminId"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "UPDATE tst.user_info set user_name = '$userName' WHERE user_id = '$userId'";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('administration', ['adminId' => $adminId]);
        }
    }

    public function changePassword()
    {
        $userId = $_POST["userId"];
        $pswd = $_POST["pswd"];
        $adminId = $_POST["adminId"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "CALL tst.change_user_password('$userId','$pswd')";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('administration', ['adminId' => $adminId]);
        }
    }

    public function addNewUser()
    {
        $userName = $_POST["userName"];
        $login = $_POST["login"];
        $pswd = $_POST["pswd"];
        $adminId = $_POST["adminId"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "CALL tst.add_new_user('$login','$pswd','$userName')";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('administration', ['adminId' => $adminId]);
        }
    }

    public function removeUser(){
        $userId = $_POST["userId"];
        $adminId = $_POST["adminId"];
        $bdController = new BdController();
        $dbConnection = $bdController->getDbConnection();
        $query = "CALL tst.delete_user('$userId')";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $this->redirectToRoute('bdError');
        } else {
            return $this->redirectToRoute('administration', ['adminId' => $adminId]);
        }
    }
}