@extends('layouts.backend')

@section('style')
    <style>
        .box-shadow {
            box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05);
        }

        #qr-canvas {
            display: none
        }

        #reader {
            position: relative;
            text-align: center;
            top: 0;
            left: 0;
            width: 100%;
            height: 200px;
            color: #fff;
            overflow: hidden;
        }

        /* #reader video {
            position: absolute;
            top: -50px;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: 100;

        } */
        #reader video {
            position: absolute;
            top: 0;
            left: -15%;
            min-width: 100%;
            min-height: 100%;
            z-index: 100;
        }

        .card {
            height: 100%;
        }

        #reader #description {
            position: absolute;
            width: 100%;
            height: 30px;
            left: 50%;
            /* top: 50%; */
            bottom: 0;
            transform: translateX(-50%) translateY(-50%);
            background: #000;
            opacity: 0.7;
            line-height: 30px;
            z-index: 10;
        }

        .swal2-cancel {
            margin-right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container" ng-app="App">

        <div class="card box-shadow mb-4" ng-controller="activityController" ng-init="start()">

            <div class="card-body">
                <p class="lead">Atividades
                    <small>Retirada/Devolução</small>
                </p>

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">Qr Code
                                <small>Leitura</small>
                            </div>
                            <div class="card-body" style="">
                                <div id="reader" class="center-block">
                                    <!-- <qr-scanner  ng-success="onSuccess(data)" ng-error="onError(error)" /> -->
                                    {{--<bc-qr-reader--}}
                                            {{--active="cameraRequested"--}}
                                            {{--on-result="onSuccess"--}}
                                            {{--camera-status="cameraIsOn"--}}
                                    {{--></bc-qr-reader>--}}
                                </div>
                            </div>
                            <div class="card-footer text-muted text-center">
                                <small id="description">@{{ loadingText }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row">

                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">Informações
                                                <small>Servidor/Aluno</small>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-sm btn-secondary" ng-click="useUserPass()">Usuário/Senha</button>
                                                    <button class="btn btn-sm btn-danger" ng-click="clearPerson()">
                                                        Limpar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="lead text-center" ng-if="!person.nome && !user_pass_use">Aguardando informações</p>
                                        <div ng-if="person.nome">
                                            <p class="lead"><b>Campus:</b> @{{ person.campi.nome }}</p>
                                            <p class="lead"><b>Tipo:</b> @{{ person.tipo }}</p>
                                            <p class="lead"><b>Nome:</b> @{{ person.nome }}</p>
                                        </div>
                                        <div ng-if="user_pass_use">
                                            <form ng-submit="checkUserPass()">
                                                <div class="form-group">
                                                    <label for="">Siape/CPF</label>
                                                    <input type="text" class="form-control" autocomplete="off" maxlength="11" autofocus ng-model="user.name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Senha</label>
                                                    <input type="password" class="form-control" autocomplete="off" ng-model="user.pass">
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-block">Verificar</button>
                                                </div>
                                            </form>
                                        </div>
                                        {{--<div class="alert alert-info">--}}
                                        {{--Servidor liberado para retirar chaves.--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-8">Informações
                                                <small>Chave</small>
                                            </div>
                                            <div class="col-md-4 text-right">
                                                <button class="btn btn-sm btn-danger" ng-click="clearKey()">Limpar
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <p class="lead text-center" ng-if="!key.copia">Aguardando informações</p>
                                        <div ng-if="key.copia">
                                            <p class="lead"><b>Sala:</b> @{{ key.room.numero }}
                                                - @{{ key.room.descricao }}</p>
                                            <p class="lead"><b>Chave cópia:</b> @{{ key.copia }}</p>
                                        </div>
                                        {{--<div class="alert alert-info">--}}
                                        {{--Servidor liberado para retirar chaves.--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="row" style="margin-top: 20px;">--}}
                        {{--<div class="col-md-6">--}}

                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                        {{----}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>

            </div>

        </div>


        <div class="row">

        </div>
        <div class="row">
            <div id="message" class="text-center">
            </div>
        </div>
    </div>
@endsection