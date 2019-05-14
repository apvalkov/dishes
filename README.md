# Тестовая задача для разработчика на Yii2.

### Инструкция по разворачиванию приложения

* Склонированить репозиторий
* Выполнить `composer install`
* Создать файл `config/db.php`, настроить подключение к БД по примеру `config/db.example.php`
* Выполнить миграции `php yii migrate`
* Заполнить базу тестовыми данными `php yii fixture/load DishesIngredients`