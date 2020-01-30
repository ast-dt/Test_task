<?php

namespace App\Controller;

use PhpParser\Node\Expr\Cast\Bool_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends AbstractController
{
    public function route()
    {
        $bdController = new BdController();
        $dbConnection =  $bdController->getDbConnection();
        $query = "SELECT user_id, role_name FROM tst.get_user_info('$_GET[loginName]','$_GET[pswd]')";
        $result = pg_query($dbConnection, $query) or die('Ошибка запроса: ' . pg_last_error());
        if (!$result) {
            return $signUpErrorPage = $this->redirectToRoute('bdError');
        }
        if ($row = pg_fetch_row($result)) {
            if ($row[1] == 'admin') {
                return $this->redirectToRoute('administration', ['adminId' => $row[0]]);
            } else {
                return $this->redirectToRoute('profile', ['userId' => $row[0]]);
            }
        } else {
            return $this->redirectToRoute('signError');
        }
    }
}

