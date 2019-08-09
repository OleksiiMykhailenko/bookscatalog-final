1. Понадобится composer, переходим на сайт getcomposer.org->Download;
2. Переходим на сайт laravel.com. Установим через terminal. composer create-project --prefer-dist laravel/laravel books-katalog;
3. Нам понадобится база данных. Подключимся: mysql -u root -p;
4. Создадим новую базу данных: create database bookskatalog;
5. Далее откроем наш проект laravel, нас интересует файл .env, а именно базовые настройки подключения к базе данных, также
мы тут можем писать кастомные настройки. Этот файл мы скрываем в git, для каждой локальной сети он будет уникальным.
А вот файл env.example обязателен для того, чтобы все члены команды могли ознакомится с настройками.
6. После создания базы данных к ней необходимо подключится. В файле .env:
                    DB_DATABASE = bookskatalog
                    DB_USERNAME = root
                    DB_PASSWORD =
7. Теперь нам необходимо спланировать нашу базу данных. В Laravel уже подготовлен удобный инструмент для создания таблиц в нашей
базе данныхб называется миграции, он тесно взаимодействует с конструктором таблиц Laravel Schema. Это своеобразная система контроля
версий нашей базы данных, в которой мы можем создавать, изменять и удалять наши таблицы. И все участникки нашей комманды
разработки смогут это видеть, как формировалась наша база данных. Доступны они в каталоге:
                    database->migrations
8. Создадим там свою миграцию. Название файла миграции состоит из времени создания ее(файл будет выполнятся поочередно) в
процессе этого будет формироватся гаша база данных. Нам понадобится своя миграция, в которой создадим таблицу, с которой
юудем работать. В terminal ввудем команду:
                    php artisan make:migration create_books_table --create=books
В случае успешного выполнения, выдаст команду:
                    Created Migration: 2019_07_27_055232_create_books_table
9. Появился файл с нашей миграцией, внутри файла используется конструктор Schema, который позволяет создать таблицы, изменять их,
удалять. Базовой есть таблица с id, который автоматически имплементируется. И timestamp, где будет отображаться дата создания и
изменения записи.
10. Добавим дополнительные необходимые поля:
                    $table->string('title')   <-название
                    $table->string('author')  <-автор
                    $table->text('intro')   <-вступительная информация о книге
                    $table->text('body')      <-аннотация
11. Мы видим внутри нашего класса два метода up() и down(). Тоесть при выполнении миграции будет выполнятся метод up() и
создасться наша таблици. Если мы захотим откатить нашу миграцию, выполнится метод down(), который удалит нашу таблицу, если
она существует.
12. Для выполнения в terminal:
                    php artisan migrate
13. Далее необходимо наполнить нашу базу данных. В Laravel предусмотрен удобный механизм, который называется seeds. Мы мржем сразу
создавать несколько правил, как заполнять базу данных. Если будут присутствовать другие разработчики, они смогут сразу простой
командой получить значения таблицы.
14. Нам необходимо создать специальный класс, в ктором будут хранится базовые записи:
                    php artisan make:seeder BooksTableSeeder
15. Открываем повосозданный seeder в папке seeds. В методе run() необходимо прописать:
                    DB::table('books')->insert(
                    array(
                    [
                    'title' => 'some text',
                    'author' => 'some text',
                    'intro' => 'some text',
                    'body' => 'some text'
                    ]
                    );
И так повторяем трижды.
16. Для того, чтобы наш файл seeder выполнился, нам необходимо добавить его в класс DatabaseSeeder.php:
                    public function run()
                    {
                        $this->call(BooksTableSeeder::class);
                    }
17. Выполним команду:
                    php artisan db:seed
Ceeder выполнился и наша таблица в базе данных заполнилась. Теперь каждый раз, когда кто-то будет клонировать наш проект либо
будут происходить какие-то изменения и мы будем заново разворачивать базу данных, юлагодаря миграции, она автоматически развернется
со всей структурой базы данных, благодаря seeder она будет наполнена тестовыми данными.
18. Необходимо как-то представить наши данные или view(макеты), которые будут содержать наш html код. Воспользуемся фреймворком
bootstrap.
19. Виды находятся в папке resource/views. Более подробно поработаем с шаблонизаторо Blade. Желательно сделать общий шаблон
и внутри наших файлов хранить только необходимые изменения(часть, которая меняется);
20. В папке views создадим папку layouts, в которой будут составные части шаблонов. В ней создадим файл:
                    layout.blade.php
Все содержимое bootstrap шаблона перенесм в этот файл;
21. Создадим меню спомощью include, в body;
22. Создадим файл headerNavigator.blade.php, в котором будет панель навигации, и изменим ее под себя. Опять таки используем шаблонизатор
bootstrap;
23. Теперь необходимо в файле layout.blade.php создать область, в которой будет меняющееся содержимое(контент каталога):
                    <div class="container">
                        @yield('content')
                    </div>
Сюда будут подставляться данные, которые меняються от странице к странице;
24. Теперь необходимо подключить наш шаблон к файлу index.blade.php, пропишем в файле:
                    @extends('layouts.layout')
                    @section('content')
                    @endsection
25. Теперь нам необходимо вывести данные из нашего файла с роутами. В чем еще особенность blade, он нас не ограничивает в
использовании php. В файле index.blade.php:
                    @foreach($posts as $post)
                    <div class="col-md-4">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->author }}</p>
                    <p>{{ $post->intro }}</p>
                    <p><a href="/posts/{{$post->alias}}" class="btn btn-dark">Read more</a></p>
                    </div>
                    @endforeach
                    </div>
26. Далее нам необходимо показывать заголовок и основной текст, но для этого нам не хватает представления;
27. В view создадим отдельную папку books и в ней будет представление с именем show, создадим файл:
                    show.blade.php
В нем напишем:
                    @extends('layouts.layout')
                    @section('content')
                    <div class="row">
                        <div class="col-md-8 blog-main">
                        <div class="book-post">
                        <h2 class="book-post-title">{{$post->title}}</h2>
                        <p class="book-post-author">{{$post->authow}}</p>
                    <p>
                        {{$post->body}}
                    </p>
                    </div>
                    </div>
                    </div>
                    @endsection
28. Для того, чтобы вынести логику связывания с базой данных и наших представлений, у нас есть контроллеры. Контроллеры
смогут группировать нашу обработку http запросов отдельных классов, хранятся в каталоге http controllers;
29. Создадим контроллерю В terminal:
                    php artisan make:contoller BooksController
В нем мы определим наши базовые методы или экшены.
30. Далее нам понадобится модель. Мы создадим класс модель, который будет использоваться для работы с нашей таблицей books,
выполним команду в terminal:
                    php artisan:make model Book
Модель появилась в корне http, можем ей пользоваться.
31. Создадим новый метод создания отображения записей. Понадобиться новый маршрут, в файле web.php:
                    Route::get('/books/create', "BooksController@create");
32. В котнроллере создадим соответствующий метод:
                    public function create()
                    {
                        return view("books.create");
                    }
33. Теперь необходимо создать представление. В views/books, создадим файл:
                    create.blade.php
Понадобиться форма, в файле:
                    @extends('layouts.layout')
                    @section('content')
Создадим простую форму title, author, intro, body. И подключим форму к меню, в файле headerNavigator.php
34. Нам необходимо добавить alias и мы для этого создадим еше одну миграцию. В terminal:
                    php artisan make:migration update_books_table
Это будет миграция, которая изменит текущую таблицу;
35. Нам необходимо заполнить наши методы up(), down(). Мы используем класс Schema, это некий конструктор. В методе up():
                    public function up()
                    {
                    Schema::table('books', function (Blueprint $table)
                    {
                    $table->string('alias');
                    });
                    }
Тоесть тут будет хранится заголовок книги латинскими. А в методе down(), если будет происходить откат миграции:
                    public function down()
                    {
                    Schema::table('books', function (Blueprint $table)
                    {
                    $table->dropColumn('alias');
                    });
                    }
Колонка alias будет удалена, при откате наших миграций.
36. В seeds->BooksTableSeeder.php необходимы небольшие изменения, необходимо добавить поле alias:
                    'alias' => "Atlas Shrugged"
                    'alias' => "The Fountainhead"
                    'alias' => "We the Living"
Теперь есть специальные сиды, механизм наполнения нашей базы данных начальными данными.
37. Выполним команду:
                    php artisan migrate:refresh --seed
Она полностью выполнит откат миграции, заново их запустит, и так же --seed выполнит сидирование(автоматически заполнит базу
данных). В конце нашей таблицы появились seed и alias. Теперь достаточно выполнить одну эту команду и выполнится заполнение
таблицы тестовыми данными;
38. Laravel автоматически находит таблицу с названием нашей модели в нижнем регистре и в множественном числе. Тоесть если есть
модел Book, а таблица books, то Laravel из свяжет между собой автоматически;
39. Перейдем к нашему контроллеру BooksController.php, изменим метод show:
                    public function show(Book $book)
                    {
                        return view('books.show', compact('book'));
                    }
40. В Route соответсвенно мы должны указать:
                    Route::get('/books/{book}', "BooksController@show");
Это называется неявное привязывание модели, модель создается, но мы нигде не видем как это происходит. Название переменной
куда будет записываться экземпляр($book)должен совпадать с частью нашего маршрута;
41. Перейдем к форме добавления записей, оптимизируем ее. А также добавим:
                    action="/book" method="post"
42. Далее перйдем к файлу web.php и в виде комментариев будем делать пометки. В целом мы сейчас реализуем маршруты для всех наших
типов действий:
                    /*
                    * GET /books
                    * GET /books/create
                    * POST /books
                    * GET /books/{id}/edit
                    * PATCH /books/{id}
                    * GET /books/{id}
                    * DELETE /books/{ID}
                    */
43. Перейдем в наш BooksController.php и создадим метод сохранения данных, после их получения, а также мы делаем проверку данных,
указали что все поля обязательны к заполнению:
                    public function store()
                    {
                        $this->validate(request(), [
                        'title' => 'required|min:2',
                        'alias' => 'required',
                        'author' => 'required',
                        'isbn' => 'required|unique:books',
                        'intro' => 'required',
                        'body' => 'required',
                    ]);
44. Соответственно в файле web.php:
                    Route::post('/book', "BooksController@store");
45. В Laravel присутствует защита через CSRF token, формируется для каждой сессии пользователя, при каждой загрузке страницы.
И когда отправляется форма, token сравнивается с token, который был сформирован, если он правильный, то форма сохраняется.
Необходимо в файле create.blade.php, в форму добавить:
                    {{csrf_field()}}
У нас в итоге в коде основном появится поле type='hidden', и скрытое значение token, которое будет передано, и если token
правильный, то пройдет успешно отправка формы.
46. Laravel автоматически из массива запрещает присваивать значения, во избежании внедрения стороннего кода. Для того, чтобы
этим методом воспользоваться, нам необходимо перейти в модель и прописать свойство, для того чтобы мы эти поля потом на лету
создавали:
                    protected $fillable = ['title', 'alias', 'author', 'isbn', 'intro', 'body'];
47. Вернемся в BooksController.php и изменим:
                    Book::create(
                    request(array('title', 'alias', 'author', 'isbn', 'intro', 'body'))
                    );
                    return redirect('/');
48. Во view укажем вывод наших ошибок, почему форма не отправляется. Вывод ошибок будет в error, которая автоматически создается,
в файле create.blade.php:
                    @include('layouts.error')
49. А в папке layouts создадим файл error.blade.php, в котором пропишем код проверки ошибок:
                    @if(count($errors))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        </div>
                    @endif
50. Теперь создадим функцию редактирования записей. Для начала нам необходимо показать форму редактирования, мы методом GET
будем обращаться по маршруту:
                    /books/{book}/edit
таким образом построим rest.api и сможем отображать форму. В файле web.php:
                    Route::get('/books/{book}/edit', "BooksController@edit");
51. В файле BooksController.php:
                    public function edit(Book $book)
                    {
                        return view("books.edit", compact('book'));
                    }
понадобится сначала модель, чтобы увидеть данные;
52. Необходимо создать наше представление. Создадим в папке books файл edit.blade.php, скопируем туда форму с create и
немного изменим ее. Подключим валидацию;
53. Мы столкнемся с такой сложностью, что формы поддерживают только метод GET или POST. В Laravel реализована возможность
обойти эту проблему, мы можем добавить скрытое поле, в котором будет храниться название метода, которым мы хотели бы воспользоваться.
В файле этом же пропишем:
                    {{csrf_field()}}
                    {!! method_field('patch') !!}
Laravel увидит эту форму и сразу определит, что мы обращаемся по методу patch;
54. Теперь перейдем в файл web.php и добавим еще один маршрут:
                    Route::patch('/books/{book}', "BooksController@update");
Тоесть форму показали в методе edit, теперь нам необходимо эти данные сохранить(если они валидны);
55. Теперь реализуем его, переходим в контроллер BooksController.php:
                    public function update(Book $book)
                    {
                        $this->validate(request(), [
                        'title' => 'required|min:2',
                        'alias' => 'required',
                        'author' => 'required',
                        'isbn' => 'required|unique:books',
                        'intro' => 'required',
                        'body' => 'required',
                    ]);
                    $book->update(request(array('title', 'alias', 'author', 'isbn', 'intro', 'body')));
                    return redirect('/');
                    }
56. Удаление записей производим: В файле index.blade.php, добавим новую кнопку с формой:
                    {{csrf_field()}}
                    {!! method_field('delete') !!}
                    <button type="submit" class="btn btn-outline-dark">Delete</button>
57. В файле web.php добавляем маршрут к этой кнопке:
                    Route::delete('/books/{book}', "BooksController@destroy");
58. Реализовываем метод destroy в BooksController.php
                    public function destroy(Book $book)
                    {
                        $book->delete();
                        return redirect('/');
                    }
59. Делаем привязку по alias. В модели Book.php, добавляем следующий метод:
                    public function getRouteKeyName()
                    {
                        return 'alias';
                    }
Теперь поиск будет по alias. в файле index.blade.php во всех полях указываем $book->alias;
60. Добавим поиск по названию. Для этого создадим роут в web.php:
                    Route::get('/search', "BooksController@search");
61. Затем создаем соответствующий метод в BooksController.php:
                    public function search(Request $request)
                    {
                        $search = $request->get('search');
                        $books = DB::table('books')->where('title', 'like', '%'.$search.'%')->get();
                        return view('books.show', ['books' => $books]);
                    }
62. И создадим представление, в файле books.show;
63. Также в контроллере к методу store добавим добавление обложки при создании книги:
                    $path = $request->file('image')->store('uploads', 'public');

                    $storageLink = basename($path);
                    $request = request(array('title', 'alias', 'author', 'isbn', 'intro', 'body'));
                    $request['cover'] = $storageLink;
                    Book::create(
                    $request
                    );
                    return redirect('/');
64. И соответствующее представление в файле books.show;
65. Для изменения книги в методе update в BooksController.php добавим:
                    $requestParams = request(['title', 'alias', 'author', 'isbn', 'intro', 'body']);
                    $path = $request->file('image')->store('uploads', 'public');
                    $storageLink = basename($path);
                    $requestParams['cover'] = $storageLink;
                    $book->update($requestParams);
                    return redirect('/');
А в передаваемых параметрах:
                    Book $book, Request $request
66. И соответственно в edit.blade.php необходимо добавить:
                    <h2>Add cover:</h2>
                    <div class="form-group">
                         <input type="file" name="image">
                    </div>
67. В файл headerNavigator.blade.php добавляем шаблоны для регистрации и авторизации;
68. Соответственно во всех view связанных с регистрацией и авторизацией мы укажим:
                    @extends('layouts.layout')
69. Для правильного отображения фотограций на странице детального просмотра, необходимо выполнить команду:
                    php artisan storage:link
70. Распределение ролей. Пропишем в новосозданной модели User.php функции для получения названия роли к которой
пользователь принадлежит:
                    protected $fillable = [
                    'name',
                    'email',
                    'password'
                    ];

                    public function roles()
                    {
                        return $this->belongsToMany(Role::class, 'users_roles', 'user_id', 'role_id');
                    }
71. Далее проверка имеет ли пользователь определенную роль:
                    public function hasRole($check)
                    {
                        if ($check = '*') {
                        return true;
                    }
                        return $this->roles->contains('name', $check);
                    }
Мы возвращаем к колекции ролей, связанной с пользователем, метод contains проверяет есть ли в колеции roles ключ с именем
name со значением $check
72. Далее пропишем такие методы как возможность редактирования и удаления:
                    public function canEdit()
                    {
                        return $this->hasRole('admin');
                    }

                    public function canView()
                    {
                        return $this->hasRole('*');
                    }
Как видно, просматривать могут все пользователи, редактировать удалять книги только админ
73. Соответственно в файле index.blade.php мы в форме в необходимом нам поле указываем:
                    @if (\Illuminate\Support\Facades\Auth::user()->canVIew())
                    @endif
Либо:
                    @if (\Illuminate\Support\Facades\Auth::user()->canEdit())
                    @endif
А также в файле headerNavigator.blade.php укажем, что добавлять новую книгу может только admin:
                    @if (\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                    <a class="nav-link" href="/books/create">Add book</a>
                    @endif
74. Также заключаем эти куски кода в:
                    @guest
                    guest stuff here
                    @else
                    logged user stuff here
                    @endauth
Для того, чтобы выводило необходимый контент незарегестрированному пользователю
75. Для того, чтобы все это работало, регистрируемся, указываем в базе данных в таблице roles
                    id - 1
                    name - admin
что соответствует id полю нашего зарегестрированного пользователя в папке users, так как таблицы связаны
76. Для проверки работоспособности изменяем строку в моделе User.php:
                    return !$this->roles->contains('name', $check);
77. Если возникли проблемы с тем, когда разлогинился, что не можешь войти в систему обратно, под тем же
мейлом и паролем, то необходимо почистить кеш:
                    php artisan view:cache
                    php artisan cache:clear
