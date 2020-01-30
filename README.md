# Test_task
Для запуска проекта требуются: 
  PHP 7.2.5 и выше (Например, сборка WAMP http://www.wampserver.com/ru/#wampserver-64-bits-php-5-6-25-php-7)
  Composer 1.9.2 и выше (https://getcomposer.org/download/)
  Symfony 5.0.3 и выше (https://symfony.com/download)
  PostgreSql 12 версии (https://www.postgresql.org/download/)

Пример установки:
1) Устанавливаем PostgreSql.
2) Устаналиваем WAMP Server, он содержит в себе php необходимой версии с предустановлеными плагинами.
3) Устанавливаем Composer.
4) Устанавливаем Symfony.
5) Запускаем WAMP Server, лонг клик ПКМ на иконку WAMP Server в трее -> PHP -> PHP Extensions -> включаем pgsql, pdo_pgsql
6) Лонг клик ПКМ на иконку WAMP Server в трее -> PHP -> Version -> Выбираем 7.4.0
7) Открываем файл foo\bin\php\php7.4.0\php.ini, где foo - директория WAMP Server
8) Находим extension=pdo_pgsql и extension=pgsql и удаляем ; перед ними.
9) Клонируем репозиторий
10) Запускаем pgAdmin, восстанавливаем базу из бэкапа в папке bd_backup репозитория.
11) Запускаем командную строку из директории репозитория
12) Выполняем команду Symfony server:start
