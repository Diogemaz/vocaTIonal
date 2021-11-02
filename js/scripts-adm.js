$(document).ready(function() {
    abriPagina();
});

$("#form-trilhas").on("submit", function(e) {
    e.preventDefault(); // impedir o evento submit
    var form = $('#form-trilha').serialize();
    $.ajax({
        type: 'POST',
        url: '../controller/cadastrarTrilha.php',
        dataType: "json",
        data: form,
        success: function(response) {
            if (response == 1 || response == 2) {
                trilha($('#area option:selected').val());
                $('#form-trilha').each(function() {
                    this.reset();
                });
            } else if (response == 0) {
                $('.alert-warning').text("Falha ao cadastrar, tente novamente");
                $('.alert-warning').show();
                setInterval(() => {
                    $('.alert-warning').text("");
                    $('.alert-warning').hide('close');
                }, 5000);
            } else if (response == -2) {
                $('.alert-warning').text("Nome da profissão deve ter letras");
                $('.alert-warning').show();
                setInterval(() => {
                    $('.alert-warning').text("");
                    $('.alert-warning').hide('close');
                }, 5000);
            }
        },
        error: function(response) {
            $('.alert-danger').text("ERRO!" + response);
            $('.alert-danger').show();
            setInterval(() => {
                $('.alert-danger').text("");
                $('.alert-danger').hide('close');
            }, 5000);
        }
    });
})
jQuery(function($) {
    $("#botao_ponto").on("click", function() {
        contadorTextos = $("[id^=botao-seletor]").length
        $("#pontos").append(
            "<button type='button' class='circulo' id='botao-seletor' onclick='EscolheItem(" + (
                contadorTextos + 1) + ")'>" + (contadorTextos + 1) +
            "</button> ")
        $("#texto-pontos").append(
            "<div class='form-group row' id='edit-ponto'><label for='texto' class='col-sm-12 text-center control-label col-form-label'>Texto " +
            (contadorTextos + 1) +
            "<button type='button' class='close' onclick='excluirPonto(" + (
                contadorTextos + 1) + ")'><span aria-hidden='true'>&times;</span></button></label><textarea rows='70' required id='texto' name='texto" +
            contadorTextos +
            "' data-ls-module='charCounter' oninput='if(this.scrollHeight > this.offsetHeight) this.rows += 1'></textarea></div>"
        )
        conteudos = $("[id^='edit-ponto']")
        for (i = contadorTextos; i > 0; i--) {
            conteudos[i].style.display = "none";
        }
        contadorTextos++;
    })
})

function excluirPonto(item) {
    conteudos = $("[id^='edit-ponto']");
    pontos = $("[id^=botao-seletor]");
    for (i = 0; i < conteudos.length; i++) {
        if (i == parseInt(item) - 1) {
            conteudos[i].parentNode.removeChild(conteudos[i]);
            pontos[i].parentNode.removeChild(pontos[i]);
        }
    }
}

function EscolheItem(item) {
    conteudos = $("[id^='edit-ponto']");
    for (i = 0; i < conteudos.length; i++) {
        if (i != parseInt(item) - 1) {
            conteudos[i].style.display = "none";
        } else {
            conteudos[i].style.display = "";
        }
    }
}

function deletarProfissao() {
    var funcao = "Excluir";
    alterarDeletarProfissao(funcao);
}

function alterarProfissao() {
    var funcao = "Alterar";
    alterarDeletarProfissao(funcao);
}

function alterarDeletarProfissao(funcao) {
    var form = $('#form-profissao').serialize() + '&funcao=' + funcao;
    console.log(form);
    $.ajax({
        type: 'POST',
        url: '../controller/alterarProfissao.php',
        dataType: "json",
        data: form,
        success: function(response) {
            if (response == 1) {
                $('.alert-success').text("Alterado/deletado com sucesso!");;
                $('.alert-success').show();
                setInterval(() => {
                    $('.alert-success').text("");
                    $('.alert-success').hide('close');
                }, 5000);
                profissao($('#area option:selected').val());
            } else if (response == 0) {
                $('.alert-warning').text("Falha ao alterar, tente novamente");
                $('.alert-warning').show();
                setInterval(() => {
                    $('.alert-warning').text("");
                    $('.alert-warning').hide('close');
                }, 5000);
            }
        },
        error: function(response) {
            $('.alert-danger').text("ERRO!" + response);
            $('.alert-danger').show();
            setInterval(() => {
                $('.alert-danger').text("");
                $('.alert-danger').hide('close');
            }, 5000);
        }
    });
};


function deletarTrilha() {
    var funcao = "Excluir";
    alterarDeletarTrilha(funcao);
}

function alterarTrilha() {
    var funcao = "Alterar";
    alterarDeletarTrilha(funcao);
}

function alterarDeletarTrilha(funcao) {
    alert("oi")
    var form = $('#form-trilha-at').serialize() + '&funcao=' + funcao;
    console.log(form);
    $.ajax({
        type: 'POST',
        url: '../controller/alterarTrilha.php',
        dataType: "json",
        data: form,
        success: function(response) {
            if (response == 1) {
                $('.alert-success').text("Alterado/deletado com sucesso!");;
                $('.alert-success').show();
                setInterval(() => {
                    $('.alert-success').text("");
                    $('.alert-success').hide('close');
                }, 5000);
                trilha($('#area option:selected').val());
            } else if (response == 0) {
                $('.alert-warning').text("Falha ao alterar, tente novamente");
                $('.alert-warning').show();
                setInterval(() => {
                    $('.alert-warning').text("");
                    $('.alert-warning').hide('close');
                }, 5000);
            }
        },
        error: function(response) {
            $('.alert-danger').text("ERRO!" + response);
            $('.alert-danger').show();
            setInterval(() => {
                $('.alert-danger').text("");
                $('.alert-danger').hide('close');
            }, 5000);
            console.log(response)
        }
    });
};


function trilhas(area) {
    $('#retorno').html("");
    $('#retorno').load("../controller/consultarTrilhas.php", {
        area: area
    });
}

function abriPagina() {
    if ($('#areaSelect option:selected').val() == 0) {
        var elemento = "<h2>Nenhuma Área selecionada</h2>";
        document.getElementById('retorno').innerHTML = elemento;
    } else {
        trilha($('#areaSelect option:selected').val());
    }
}