# Airlogic

## Оглавление

[1.Описание](#description "Описание") <br>
[2.Документация](#doc "Документация") <br>
[3.Поднятие проекта](#projectUp "Поднятие проекта") <br>
[4.Тест](#test "Тест") <br>
[5.Стек](#stack "Стек") <br>
[6.Доступы](#access "Стек") <br>
[7.Задача](#task "Задача") <br>

<a name="description"></a>
### Описание
REST API JSON приложение для создания автора и книг,поиск по авторам, отображение книг locale

<a name="doc"></a>
### Документация

[1.Создание автора](#createAuthor) <br>
[2.Создание Книги](#createBook) <br>
[3.Поиск автора](#searchAuthor) <br>
[4.Информация о книге](#infoBook)


<a name="createAuthor"></a>
#### Создание автора
* **Описание:** Создание автора, принимает json с обязательным полем 'name' <br>
    **Метод:** POST <br>
    **Адрес:**
    ```sh 
  /author/create
    ```
    
    **Тело:** 
    ```sh 
    {"name":"Лев"} 
   ```
  
    **Ответ:**
  > `{"text": "Автор успешно создан","author": {"id": 75365,"name": "Лев","books": []}}`

<a name="createBook"></a>
#### Создание Книги
* **Описание:** Создание книги, принимает json с обязательным полем 'name' и 'author_id' <br>
  **Метод:** POST <br>
  **Адрес:**
  ```sh
  /book/create
  ```
  **Тело:**
  ```sh
  {"name": "школьная вечеринка","author_id": 75365}
  ```

  **Ответ:**
  > `{"text": "Книга успешно создана","book": {"id": 75293,"name": "школьная вечеринка два",
  "author": {"id": 75365,"name": "Лев","books": [{"id": 75292,"name": "школьная вечеринка"}]} } }`

<a name="searchAuthor"></a>
#### Поиск автора
* **Описание:** Поиск автора по имени, принимает name <br>
  **Метод:** GET <br>
  **Адрес:**
  ```sh
  /author/search?name=Лев
  ```
  **Ответ:**
  > `{
  "authors": [{"id": 75365,"name": "Лев","books": [{"id": 75292,"name": "школьная вечеринка"},{"id": 75293,
  "name": "школьная вечеринка два"}]}]}`

<a name="infoBook"></a>
#### Информация о книге
* **Описание:** Информация о книге  <br>
  **Параметры:**
    * _locale -- ru|en
    * id -- \d 

  **Метод:** GET <br>
  **Адрес:**
  ```sh
  /{_locale}/book/{id}
  ```

  **Ответ:**
  > `{"book": {"id": 75292,"name": "school party","author": {"id": 75365,"name": "a lion",
  "books": {"1": {"id": 75293,"name": "school party two"} } } } }`



<a name="projectUp"></a>
### Поднятие проекта
#### Linux
* Скачать репозиторий в домашнюю папку
* в файле etc/hosts добавить local
  ```sh
    127.0.0.1 airlogic.local
  ```
    
* В файле Airlogic/deployment/docker-compose/dev/.env изменить поле HOMENAME на свою домашнюю директорию
* перейти в Airlogic/deployment/docker-compose/dev выполнить
  ```sh
  docker-compose build
  ```
  ```sh
  docker-compose up -d
  ```
* Зайти в котейнер
  ```sh
  docker exec -it dev_airlogic_1 bash
  ```
* Сменить пользователя
  ```sh
  su apps
  ```
* Выполнить команды
  ```sh
  cd ~/airlogic/
  ```
  ```sh
  composer install
  ```
  ```sh
  php bin/console doctrine:migrations:migrate
  ```
  ```sh
  php bin/console doctrine:fixtures:load
  ```

<a name="test"></a>
### Тест
В корне проекта выполнить команду
  ```sh
  php ./vendor/bin/phpunite
  ```

<a name="stack"></a>
### Стек
* Symfony 5.4.6
* php7.4
* Библиотеки
  * doctrine/orm
  * jms/serialize
  * symfony/validator
  * symfony/test-pack
  * dejurin/php-google-translate-for-free
  * doctrine/doctrine-fixtures-bundle
  * symfony/yaml
  * fzaninotto/faker

<a name="access"></a>
### Доступы
Postgres <br>
* host
  ```sh
  172.17.0.1
  ```
* port
  ```sh
  54321
  ```
* login
  ```sh
  postgres
  ```
* password
  ```sh
  root
  ```
* dataBase
  ```sh
  airlogic
  ```

<a name="task"></a>
### Задача
Используя PHP 7 и фреймворк Symfony 5 (последние версии PHP 7.4 и Symfony 5.2), а также Doctrine ORM и с использованием Docker контейнера,<br>
написать REST API для создания и получения книг и авторов из базы данных в формате JSON. <br>

Требования к заданию: <br>
Написать миграцию, засеивающую тестовые таблицы ~10 000 книгами и ~10 000 авторами <br>
Реализовать запросы на создание книги и автора в базе /book/create, /author/create <br>
Реализовать запрос на получение списка книг с автором из базы /book/search c поиском по названию книги <br>
Написать Unit-тест <br>
Используя возможности Symfony по локализации контента, сделать мультиязычный метод получения информации о книге /{lang}/book/{Id},<br>
 где {lang} = en|ru и {Id} = Id книги. <br>
Формат ответа: {Id: 1, 'Name':'War and Peace|Война и мир'} - поле Name выводить на языке локализации запроса. <br>
<br>
Пример формата сущностей:
```
Автор: { 
   'Id': 1, 
      'Name': 'Лев Толстой' 
   }

   Книга: { 
      'Id': 1, 
      'Name': ' War and peace|Война и мир', 
      'Author': [ { 
         'Id': 1, 
         'Name': 'Лев Толстой' 
      }] 
   }
```
