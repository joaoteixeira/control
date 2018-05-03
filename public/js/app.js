var app = angular.module('App', ['webcam', 'bcQrReader']);


app.controller('activityController', ['$scope', '$http', function ($scope, $http) {

    $scope.loadingText = 'Aguardando Qr Code';
    $scope.person = {};
    $scope.key = {};
    $scope.devolucao = '';

    $scope.start = function() {
        $scope.cameraRequested = true;
    }

    $scope.onSuccess = function (data) {
        $scope.cameraRequested = false;
        $scope.loadingText = 'Buscando informações';

        swal({ text: 'Buscando informações', onOpen: function () { swal.showLoading() } });

        $http.post('/activities', {data: data})
            .then(function (response) {
                swal.close();
                var data = response.data;

                if (data.success) {

                    if (data.tipo == 'key')
                        $scope.key = data.data;

                    if (data.tipo == 'person')
                        $scope.person = data.data;

                    if (data.tipo == 'devolucao')
                        devolucaoChave(data.data);

                    if (data.tipo == 'pendencia')
                        pendenciaChave(data.data);
                    
                    if($scope.key.qr_code && $scope.person.qr_code) 
                        retirarChave();

                } else {
                    swal({ type: 'error', text: 'Código não encontrado!', timer: 3000 });
                }

                $scope.cameraRequested = true;
                $scope.loadingText = 'Aguardando Qr Code';
            });

    };
    $scope.onError = function (error) {
        //console.log(error);
    };
    $scope.onVideoError = function (error) {
        //console.log(error);
    };

    var retirarChave = function () {

        if ($scope.person.qr_code && $scope.key.qr_code) {

            $http.post('/activities/take', {key: $scope.key.qr_code, person: $scope.person.qr_code})
                .then(function (response) {
                    var data = response.data;

                    if (data.success)
                        swal({ type: 'success', text: 'Chave retirada com sucesso!', timer: 8000 });
                    else if (data.tipo == 'copia_retirada')
                        copiaRetirada(data.data);
                    else
                        swal({ type: 'error', text: 'Ocorreram erros ao tentar retirada chave!', timer: 8000 });

                });

            clearScopeKeyPerson();
        }
    },
    
    devolucaoChave = function (data) {
        $scope.devolucao = data.qr_code;

        var text = 'Sala ' + data.room.numero + ' - ' + data.room.descricao + ': Cópia: ' + data.copia;

        swal({
            title: 'Deseja confirmar a devolução?',
            html: text,
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {

                $http.post('/activities/back', {key: $scope.devolucao})
                    .then(function (response) {
                        if (response.data.success)
                            swal({type: 'success', title: 'Devolução confirmada!'});
                        else
                            swal({type: 'error', title: 'Ocorreu um erro na devolução!'});
                    });
            }
        });

        clearScopeKeyPerson();
    },

    pendenciaChave = function (data) {

        var text = 'Existem pendências para <b>' + data.person.nome +
            '</b><br> Favor realizar a devolução da(s) chave(s): <br><br>';

        var obs = '<br><br><span class="text-danger">* Não é permitido a entrega da chave sem resolução das pendências!</span>';

        var chaves = [];
        angular.forEach(data.keys, function (value, key) {
            this.push('<b>Sala ' + value.room.numero + ' - ' + value.room.descricao + ': Cópia ' + value.copia + '</b>');
        }, chaves);

        swal({
            type: 'warning',
            title: 'Pendências!',
            html: text + chaves.join('<br>') + obs
        });

        clearScopeKeyPerson();
    },

    copiaRetirada = function (data) {
        var text = 'Uma cópia da <b>Sala ' + data.key.room.numero + ' - ' + data.key.room.descricao +
            '</b> já foi retirada por <br><b>' + data.person.nome + '</b>';

        var obs = '<br><br><span class="text-danger">* Não é permitida a retirada da cópia da mesma sala!</span>';

        swal({ 
            type: 'warning', 
            html: text + obs 
        });

        clearScopeKeyPerson();
    },

    clearScopeKeyPerson = function () {
        $scope.key = {}
        $scope.person = {}
    },

    clearPerson = function () {
        $scope.person = {}
    },

    clearKey = function () {
        $scope.key = {}
    }
}]);
