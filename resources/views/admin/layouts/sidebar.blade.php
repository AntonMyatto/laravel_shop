<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size:14px;"> {{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Панель управления</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        @php
            $user = auth()->user();
        @endphp
    </div>

    @if($user->hasRole('root'))
        <div class="sidebar-heading">
            Пользователи
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseclient" aria-expanded="true" aria-controls="collapseclient">
                <i class="fas fa-child"></i>
                <span>О клиентах</span>
            </a>
            <div id="collapseclient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('clients.index') }}">Клиенты</a>
                    <a class="collapse-item" href="{{ route('clients-messages.index') }}">Сообщения</a>
                </div>
            </div>
        </li>
    @elseif($user->hasRole('mngr'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseclient" aria-expanded="true" aria-controls="collapseclient">
                <i class="fas fa-child"></i>
                <span>О клиентах</span>
            </a>
            <div id="collapseclient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('clients.index') }}">Клиенты</a>
                    <a class="collapse-item" href="{{ route('clients-messages.index') }}">Сообщения</a>
                </div>
            </div>
        </li>
    @elseif($user->hasRole('sc'))

    @elseif($user->hasRole('cnt'))

    @endif
    @if($user->hasRole('root'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefour"
               aria-expanded="true" aria-controls="collapsefour">
                <i class="fas fa-user-alt"></i>
                <span>Пользователи и роли</span>
            </a>
            <div id="collapsefour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('users.index') }}">Пользователи</a>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Роли</a>
                </div>
            </div>
        </li>
    @endif
    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <!-- Nav Item - Pages Collapse Menu -->
    @if($user->hasRole('root'))
        <div class="sidebar-heading">
            Содержимое
        </div>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Магазин</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('categories.index') }}">Категории</a>
                    <a class="collapse-item" href="{{ route('products.index') }}">Товары</a>
                    <a class="collapse-item" href="{{ route('posts.index') }}">Посты</a>
                    <a class="collapse-item" href="{{ route('tags.index') }}">Теги</a>
                    <div class="menu-index">
                        <a class="collapse-item test-class" href="{{ route('tests.index') }}">Тесты</a>
                        <ul class="pl-2 question-class">
                            <li class="nav-item">
                                <a class="collapse-item" href="{{ route('questions.index') }}">- Вопросы</a>
                            </li>
                        </ul>
                    </div>
                    <a class="collapse-item" href="cards.html">Реклама</a>
                    <a class="collapse-item" href="cards.html">Статистика</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Конфигурация
        </div>
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
               aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-cog"></i>
                <span>Система</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="">Интеграции</a>
                    <a class="collapse-item" href="">Местонахождение</a>
                    <a class="collapse-item" href="{{ route('currencies.index') }}">Валюта</a>
                    <a class="collapse-item" href="">Статус заказов</a>
                    <a class="collapse-item" href="">Языки</a>
                    <a class="collapse-item" href="{{ route('logs') }}">Журнал ошибок</a>
                </div>
            </div>
        </li>

    @elseif($user->hasRole('mngr'))

    @elseif($user->hasRole('cnt'))
        <div class="sidebar-heading">
            Содержимое
        </div>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Магазин</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('products.index') }}">Товары</a>
                    <div class="menu-index">
                        <a class="collapse-item test-class" href="{{ route('tests.index') }}">Тесты</a>
                        <ul class="pl-2 question-class">
                            <li class="nav-item">
                                <a class="collapse-item" href="{{ route('questions.index') }}">- Вопросы</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </li>
    @elseif($user->hasRole('sc'))
        <div class="sidebar-heading">
            Содержимое
        </div>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Магазин</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('posts.index') }}">Посты</a>
                    <a class="collapse-item" href="{{ route('categories.index') }}">Категории</a>
                    <a class="collapse-item" href="{{ route('products.index') }}">Уроки</a>
                    <a class="collapse-item" href="{{ route('tags.index') }}">Теги</a>
                    <div class="menu-index">
                        <a class="collapse-item test-class" href="{{ route('tests.index') }}">Тесты</a>
                        <ul class="pl-2 question-class">
                            <li class="nav-item">
                                <a class="collapse-item" href="{{ route('questions.index') }}">- Вопросы</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
