@extends('admin.layouts.app')

@section('content')

    <!-- Page Wrapper -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Поиск..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#"
                                   role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end"
                                     aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                        </ul>

                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-12 col-xl-12 mt-2 mb-2 text-dark">
                        <h2>Сообщения клиентов</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs nav-client">
                            <li class=" btn">
                                <a href="{{ route('clients-messages.index') }}" class="btn ">Все сообщения <span
                                        class=" text-light p-1">{{$cli_messages_count}}</span></a>
                            </li>
                            <li class="btn">
                                <a href="{{ route('clientmessages.read') }}" class="btn active">Прочитанные <span
                                        class="p-1" id="read_block">{{$cli_read_messages_count}}</span></a>
                            </li>
                            <li class="btn">
                                <a href="{{ route('clientmessages.noread') }}" class="btn">Непрочитанные <span
                                        class=" text-light p-1" id="no_read_block">{{$cli_no_read_messages_count}}</span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content ">
                        <div class="tab-pane active" id="characteristics">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @endif

                                    @if($message = Session::get('delete'))
                                        <div class="alert alert-danger">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @endif
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">№</th>
                                        <th scope="col">Телефон</th>
                                        <th scope="col">Имя</th>
                                        <th scope="col">Фамилия</th>
                                        <th>Почта</th>
                                        <th scope="col">Сообщение</th>
                                        <th scope="col">Статус</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($cli_read_messages as $client)
                                        <tr data-entry-id="{{ $client->id }}">

                                            <td>{{ $loop->iteration }}</td>
                                            <td id="email-phone_number">{{ $client->client->phone_number }}</td>
                                            <td id="email-first_name">{{ $client->client->first_name }}</td>
                                            <td id="email-last_name">{{$client->client->last_name}}</td>
                                            <td id="email-user">{{$client->client->email}}</td>
                                            <td id="status">
                                                @if($client->visited == 0)
                                                    <span class="text-white bg-danger p-1 noread" style="border-radius: 10px">Не просмотрено</span>
                                                @else
                                                    <span class="text-white bg-success p-1 read" style="border-radius: 10px">Просмотрено</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-modal"
                                                   onclick="showDetail({{ $client->id }})">
                                                    Смотреть
                                                </a>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">{{ __('Нет клиентов') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.layouts.footer')

        <!-- End of Footer -->

    </div>

@endsection

<div class="modal" tabindex="-1" id="view-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Сообщение №<span id="message_num"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div>
                    <b>Пользователь:</b>
                    <p id="user_info">
                        <span>Имя: <span id="firstnames"></span></span><br>
                        <span>Фамилия: <span id="lastnames"></span></span><br>
                        <span>Почта: <span id="emails"> </span></span><br>
                        <span>Телефон: <span id="phones"> </span></span>
                    </p>
                </div>

                <div>
                    <b>Сообщение:</b>
                    <p id="message_body"></p>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked
                           disabled>
                    <label class="form-check-label" for="flexCheckCheckedDisabled">
                        Просмотрено
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    /*
        get and display the record info on modal
    */
    function showDetail(id) {
        $("#name-info").html("");
        $("#description-info").html("");
        let url = "/clients-messages/" + id + "";

        let target = $(event.target);

        let tarPar = target.parent();

        let email = tarPar.siblings('#email-user');
        let emailphonenumber = tarPar.siblings('#email-phone_number');
        let emaillastname = tarPar.siblings('#email-last_name');
        let emailfirstname = tarPar.siblings('#email-first_name');

        let no_read_block = $('#no_read_block');
        let read_block = $('#read_block');

        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                let data = response.data;
                $('#firstnames').html(emailfirstname.html());
                $('#lastnames').html(emaillastname.html());
                $('#emails').html(email.html());
                $('#phones').html(emailphonenumber.html());
                $('#message_num').html(data.id);
                $("#message_body").html(data.message);
                no_read_block.html(data.noread);
                read_block.html(data.read);
                $("#view-modal").modal('show');

            },
            error: function (response) {
                console.log(response.responseJSON)
            }
        });
    }

</script>
