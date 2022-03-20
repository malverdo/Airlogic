# Airlogic

## Оглавление

[1.Описание](#description "Описание") <br>
[2.Документация](#doc "Документация") <br>
[3.Поднятие проекта](#projectUp "Поднятие проекта") <br>
[4.Тест](#test "Тест") <br>
[5.Стек](#stack "Стек") <br>

<a name="description"></a>
### Описание
REST API JSON приложение для создания автора и книг,поиск по авторам, отображение книг locale


### Документация

[1.Создание автора](#createAuthor) <br>
[2.Создание Книги](#createBook) <br>
[3.Поиск автора](#searchAuthor) <br>
[4.Информация о книге](#infoBook)


<a name="createAuthor"></a>
#### Создание автора
* **Описание:** Создание автора, принмает json с обязательным полем 'name' <br>
    **Метод:** POST <br>
    **Адрес:**
    > `/author/create`
    
    **Тело:**
    > `{"name":"Лев"}` 
  
    **Ответ:**
  > `{"text": "Автор успешно создан","author": {"id": 75365,"name": "Лев","books": []}}`

<a name="createBook"></a>
#### Создание Книги
* **Описание:** Создание книги, принмает json с обязательным полем 'name' и 'author_id' <br>
  **Метод:** POST <br>
  **Адрес:**
  > `/book/create`

  **Тело:**
  > `{"name": "школьная вечеринка","author_id": 75365}`

  **Ответ:**
  > `{"text": "Книга успешно создана","book": {"id": 75293,"name": "школьная вечеринка два",
  "author": {"id": 75365,"name": "Лев","books": [{"id": 75292,"name": "школьная вечеринка"}]} } }`

<a name="searchAuthor"></a>
#### Поиск автора
* **Описание:** поиск автора по имени, принмает name <br>
  **Метод:** GET <br>
  **Адрес:**
  > `/author/serach?name=Лев`

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
  > `/{_locale}/book/{id}`

  **Ответ:**
  > `{"book": {"id": 75292,"name": "school party","author": {"id": 75365,"name": "a lion",
  "books": {"1": {"id": 75293,"name": "school party two"} } } } }`



<a name="projectUp"></a>
### Поднятие проекта
#### Linux
* Скачать репозиторий в домашнюю папку
* в файле etc/hosts добавить local
  * >  127.0.0.1 airlogic.local
* В файле Airlogic/deployment/docker-compose/dev/.env изменить поле HOMENAME на свою домашнюю директорию
* перейти в Airlogic/deployment/docker-compose/dev выполнить
  * > docker-compose build
  * > docker-compose up -d
* Зайти в котейнер
  * > docker exec -it dev_airlogic_1 bash
* Сменить пользователя
  * > su apps
* Выполнить команды
  * > php bin/console doctrine:migrations:migrate
  * > php bin/console doctrine:fixtures:load

<a name="test"></a>
### Тест
В корне проекта выполнить команду
* > php ./vendor/bin/phpunit

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
