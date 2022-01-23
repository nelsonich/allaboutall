@extends('layouts.app')
@section('title', 'AllAboutAll.media')

@section('content')
    <section class="need-workers">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">

                {{ session()->get('message') }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">

                    {{ $error }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="jumbotron">
            <h1 class="display-4">Нужны волонтеры</h1>
            <p class="lead">
                Сайт создан для всех стран Кавказа. Это русскоязычная медиа-платформа, которой могут пользоваться люди, понимающие русский язык.
                Нашему стартапу AllAboutAll.media требуются волонтеры со следующими специальностями:
            </p>
            <hr class="my-4">
            <div>
                <ul>
                    <li>
                        <strong>CopyWriter</strong>
                        <br>
                        <p>Человек, умеющий писать тексты, которые будут уникальными, специализированными и относящимися к определенной категории․</p>
                    </li>
                    <li>
                        <strong>SMM-специалист</strong>
                        <br>
                        <p>Человек, который сможет увеличить аудиторию сайта через социальные сети.</p>
                    </li>
                </ul>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#apply">
                    Подать заявку
                </button>
            </div>
            <hr class="my-4">
            <p>
                Если вы специалист в другой области, но знаете, как помочь нам в развитии сайта: вы можете связаться с нами, написав на почту - <a href="mailto:info@allaboutall.media">info@allaboutall.media</a>
            </p>
        </div>

        <div class="modal fade" id="apply" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="applyLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="applyLabel">Пожалуйста, напишите следующие поля</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('apply-to-work') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-form-label">Названия:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Ел. почта:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-form-label">Роль:</label>
                            <select name="role" id="role">
                                <option value="copywriter">CopyWriter</option>
                                <option value="smm">SMM</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрить</button>
                        <button type="submit" class="btn btn-primary">Подать заявку</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
    </section>
@endsection
