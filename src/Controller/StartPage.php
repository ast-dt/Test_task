<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class StartPage
{
    public function showStartPage()
    {
        return new Response(
            '
			<!DOCTYPE html>
			<html>
				<head>
					<title>Главная страница</title>
				</head>
				<body>
					<form name="login" action="/login" method="GET">
						<p><b>Login:</b><br>
							<input type="text" name="loginName" size="40"></p>
						<p><b>Password:</b><br>
							<input type="password" name="pswd" size="40"></p>
						<p><input type="submit" value="log in"</p>
					</form>
				</body>
			</html>'
        );
    }

    public function showErrorPage()
    {
        return new Response(
            '
			<!DOCTYPE html>
			<html>
				<head>
					<title>Главная страница</title>
				</head>
				<body>
				<p><b>Не найдена пара пользователь пароль</b></p>
					<form name="login" action="/login" method="GET">
						<p><b>Login:</b><br>
							<input type="text" name="loginName" size="40"></p>
						<p><b>Password:</b><br>
							<input type="password" name="pswd" size="40"></p>
						<p><input type="submit" value="log in"</p>
					</form>
				</body>
			</html>'
        );
    }

    public function showBdErrorPage()
    {
        return new Response(
            '
			<!DOCTYPE html>
			<html>
				<head>
					<title>Главная страница</title>
				</head>
				<body>
				<p><b>Возникли проблемы с базой данных</b></p>
					<form name="login" action="/login" method="GET">
						<p><b>Login:</b><br>
							<input type="text" name="loginName" size="40"></p>
						<p><b>Password:</b><br>
							<input type="password" name="pswd" size="40"></p>
						<p><input type="submit" value="log in"</p>
					</form>
				</body>
			</html>'
        );
    }

    public function showUserNotFound()
    {
        return new Response(
            '
			<!DOCTYPE html>
			<html>
				<head>
					<title>Главная страница</title>
				</head>
				<body>
				<p><b>Пользователь не найден</b></p>
					<form name="login" action="/login" method="GET">
						<p><b>Login:</b><br>
							<input type="text" name="loginName" size="40"></p>
						<p><b>Password:</b><br>
							<input type="password" name="pswd" size="40"></p>
						<p><input type="submit" value="log in"</p>
					</form>
				</body>
			</html>'
        );
    }
}