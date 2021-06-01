/*!
    * Start Bootstrap - Creative v6.0.4 (https://startbootstrap.com/theme/creative)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-creative/blob/master/LICENSE)
    */
    (function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 72)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 75
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-scrolled");
    } else {
      $("#mainNav").removeClass("navbar-scrolled");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Magnific popup calls
  $('#portfolio').magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-img-mobile',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0, 1]
    },
    image: {
      tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
    }
  });

})(jQuery); // End of use strict
$('#nome').on('keypress', function (event) {
  var regex = new RegExp("^[a-zA-Z0-9àèìòùáéíóúâêîôûãõ \b]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
     event.preventDefault();
     return false;
  }
});
var local = window.location.pathname;
var localArray = local.split("/");
var form;
if(localArray[localArray.length - 1] == "cadastro.php"){
  form = document.getElementById('form-cadastro');
  form.addEventListener('submit', e => {
    e.preventDefault()
    console.log('Deu certo')
  })
} else if(localArray[localArray.length - 1] == "entra.php"){
  form = document.getElementById('form-login');
  form.addEventListener('submit', e => {
    e.preventDefault()
    console.log('Deu certo')
  })
}else if(localArray[localArray.length - 1] == "profissoes.php"){
  form = document.getElementById('form-favorita');
  form2 = document.getElementById('comentar');
  form2.addEventListener('submit', e => {
    e.preventDefault()
    console.log('Deu certo')
  })
  form.addEventListener('submit', e => {
    e.preventDefault()
    console.log('Deu certo')
  })
}else if(localArray[localArray.length - 1] == "cursos.php"){
  form = document.getElementById('comentar');
  form.addEventListener('submit', e => {
    e.preventDefault()
    console.log('Deu certo')
  })
}
function modalSenha(){
  form = document.getElementById('form-altUserSenha');
  form.addEventListener('submit', e => {
    e.preventDefault()
    console.log('Deu certo')
  })
}

function forcaSenha(){
  var cor;
  var text;
  var forcaMi = 0;
  var forcaMa = 0;
  var forcaN = 0;
  var forcaE = 0;
  var letrasMaiusculas = /[A-Z]/;
  var letrasMinusculas = /[a-z]/; 
  var numeros = /[0-9]/;
  var caracteresEspeciais = /[!|@|#|$|%|^|&|*|(|)|-|_]/;
  var string = $('#senha').val();
  for(i=0;i<string.length; i++){
    if(letrasMinusculas.test(string[i])){
      forcaMi++;
    }
    if(letrasMaiusculas.test(string[i])){
      forcaMa++;
    }
    if(numeros.test(string[i])){
      forcaN++;
    }
    if(caracteresEspeciais.test(string[i])){
      forcaE++;
    }
  }
  if(forcaN > 0 && forcaMi > 0 && forcaMa > 0 && forcaE > 0){
    text = "senha forte";
    cor = "#59b300";
  }else if(forcaN > 0 && forcaMi > 0){
    text = "senha media";
    cor = "#ffdd33";
  }else if(forcaMi > 0){
    text = "senha fraca";
    cor = "#ff3333";
  }else if(forcaMa > 0){
    text = "senha fraca";
    cor = "#ff3333";
  }else if(forcaN > 0){
    text = "senha fraca";
    cor = "#ff3333";
  }
  console.log(text);
  $('#conteudo').text(text).css("background-color", cor);
  $("#conteudo").show();
}
$('#senha').blur(function(){
  $('#conteudo').hide();  
})
//este é preciso também para não esconder quando clica no grupos ou conteudo
$("#senha, #conteudo").click(function(e){
  e.stopPropagation(); 
});
function cadastrar(){
  if(verifica()){
    var form = $('#form-cadastro').serialize();
    console.log(form);
    $.ajax({
      type: 'POST',
      async: true,
      url: '../controller/enviarEmail.php',
      data: form,
      datatype: 'json',
      cache: true,
      global: false,
      beforeSend: function() { 
          $('#loader').show();
      },
      success: function() {
        $.ajax({
          type:'POST',
          url:'../controller/cadastrarUsuario.php',
          dataType: "json",
          data: form,
          success: function(response){
            if(response == -4){
              $('#resposta').text('Campo vazio');
              $('.alert-warning').show();
              setInterval(() => {
                $('#resposta').text("");
                $('.alert-warning').hide('close');
              }, 10000);
            }else if(response == -3){
              $('#resposta').text('Senha deve ter pelo menos 8 digitos');
              $('.alert-warning').show();
              setInterval(() => {
                $('#resposta').text("");
                $('.alert-warning').hide('close');
              }, 10000);
            }else if(response == -2){
              $('#resposta').text("As senhas digitadas não são iguais");
              $('.alert-warning').show();
              setInterval(() => {
                $('#resposta').text("");
                $('.alert-warning').hide('close');
              }, 10000);
            }else if(response == -1){
              $('#resposta').text("Falha ao cadastrar, tente novamente ou entre em contato com o suporte do site");
              $('.alert-danger').show();
              setInterval(() => {
                $('#resposta').text("");
                $('.alert-danger').hide('close');
              }, 10000);
            }else if(response == 0){
              $('#resposta').text("Email já cadastrado no site");
              $('.alert-warning').show();
              setInterval(() => {
                $('#resposta').text("");
                $('.alert-warning').hide('close');
              }, 10000);
            }else if(response == 1){
              console.log(response);
              $('.alert-success').text("Verifique seu email para confirmar sua conta");
              $('.alert-success').show();
              setInterval(() => {
                $('#resposta').text("");
                $('.alert-success').hide('close');
              }, 10000);
              $('#form-cadastro').each (function(){
                this.reset();
              });
            }
          },
          error: function(response){
            alert("erro ao cadastrar");
            console.log("erro"+response);
          }
      });
      },
      error: function(response){
        alert("erro ao enviar email");
        console.log("erro"+response);
      },
      complete: function() { 
          $('#loader').hide();
      }
    });
  }else{}
};
function checarEmail(){
  if($('#email').val()=="" || $('#email').val().indexOf('@')==-1 || $('#email').val().indexOf('.')==-1){
    $('.alert-warning').text("Por favor, informe um E-MAIL válido!");
    $('.alert-warning').show();
    setInterval(() => {
      $('.alert-warning').text("");
      $('.alert-warning').hide('close');
    }, 5000);
    return false;
  }
}
function verifica() {
  var regex = new RegExp("^[a-zA-Z0-9àèìòùáéíóúâêîôûãõ\b]+$");
  if($('#email').val() == ''){
    $('#resposta').text('Por favor, informe o seu EMAIL.');
    $('.alert').show();
    setInterval(() => {
      $('#resposta').text("");
      $('.alert').hide('close');
    }, 10000);
    $('#email').focus();
    return false;
  }else if($('#nome').val() == ''){
    $('#resposta').text('Por favor, informe o seu NOME DE USUÁRIO.');
    $('.alert').show();
    setInterval(() => {
      $('#resposta').text("");
      $('.alert').hide('close');
    }, 10000);
    $('#nome').focus();
    return false;
  }else if($('#senha').val() == ''){
    $('#resposta').text('Por favor, informe o sua SENHA.');
    $('.alert-warning').show();
    setInterval(() => {
      $('#resposta').text("");
      $('.alert-warning').hide('close');
    }, 10000);
    $('#senha').focus();
    return false;
  }else if($('#confSenha').val() == ''){
    $('#resposta').text('Por favor, Preencha o campo CONFIRMAR SENHA.');
    $('.alert--warning').show();
    setInterval(() => {
      $('#resposta').text("");
      $('.alert-warning').hide('close');
    }, 10000);
    $('#confSenha').focus();
    return false;
  }else if($('#senha').val().length < 8){
    $('#resposta').text('Senha deve ter pelo menos 8 digitos');
    $('.alert-warning').show();
    setInterval(() => {
      $('#resposta').text("");
      $('.alert-warning').hide('close');
    }, 10000);
    $('#senha').focus();
    return false;
  }else if (!regex.test($('#nome').val())) {
    $('#resposta').text('Nome não deve ter caracter especial.');
    $('.alert-warning').show();
    setInterval(() => {
      $('#resposta').text("");
      $('.alert-warning').hide('close');
    }, 10000);
    $('#nome').focus();
    return false;
  }else{
    return true;
  }
}

function login(){
  var form = $('#form-login').serialize();
  console.log(form);
  $.ajax({
      type:'POST',
      url:'../controller/login.php',
      dataType: "json",
      data: form,
      success: function(response){
        if(response == 1){
          window.location.href = "../view/areaUsuario.php";
        } else if(response == -1){
          $('#resposta').text("Email ou senha incorretos");
          $('.alert').show();
          setInterval(() => {
            $('#resposta').text("");
            $('.alert').hide('close');
          }, 10000);
        } else if(response == -2 || response == -4 || response == 0){
          $('#resposta').text("Falha no login, tente novamente ou entre em contato");
          $('.alert').show();
          setInterval(() => {
            $('#resposta').text("");
            $('.alert').hide('close');
          }, 10000);
        } else if(response == 2){
          console.log(response);
          window.location.href = "../view/adm-dashboard.php";
        }else if(response == -3){
          $('#resposta').text("Usuario não verificado");
          $('.alert').show();
          setInterval(() => {
            $('#resposta').text("");
            $('.alert').hide('close');
          }, 10000);
        }
      },
      error: function(response){
          console.log("erro"+response);
      }
  });
};
function favorita(){
  var user = $('#user').val();
  if(user != ""){
  var dado = $('#favoritar').text();
  console.log(dado);
  if(dado == "Favoritar área"){
    console.log("1");
    $.ajax({
        type:'POST',
        url:'../controller/favoritaArea.php',
        dataType: "json", 
        data: {funcao: dado},
        success: function(response){
          if(response == 1){
            $('#favoritar').html("Remover Favorito");
            $('.alert-success').text("Favoritado!");
            $('.alert-success').show();
            setInterval(() => {
              $('.alert-success').text("");
              $('.alert-success').hide('close');
            }, 5000);
          }else if(response == 0){
            $('.alert-warning').text("Falha ao cadastrar, tente novamente");
            $('.alert-warning').show();
            setInterval(() => {
              $('.alert-warning').text("");
              $('.alert-warning').hide('close');
            }, 5000);
          }else if(response == -1){
            alert("Falha!");
          }
        },
        error: function(response){
          alert("erro1");
          console.log("erro"+response);
        }
    });
  }else if(dado == "Remover Favorito"){
    console.log("2");
    $.ajax({
      type:'POST',
      url:'../controller/favoritaArea.php',
      dataType: "json",
      data: {funcao: dado},
      success: function(response){
        if(response == 1){
          $('#favoritar').html("Favoritar área");
          $('.alert-success').text("Favorito Removido!");
          $('.alert-success').show();
          setInterval(() => {
            $('.alert-success').text("");
            $('.alert-success').hide('close');
          }, 5000);
        }else if(response == 0){
          $('.alert-warning').text("ERRO!");
          $('.alert-warning').show();
          setInterval(() => {
            $('.alert-warning').text("");
            $('.alert-warning').hide('close');
          }, 5000);
        }else if(response == -1){
          $('.alert-warning').text("ERRO!");
          $('.alert-warning').show();
          setInterval(() => {
            $('.alert-warning').text("");
            $('.alert-warning').hide('close');
          }, 5000);
        }
      },
      error: function(response){
        $('.alert-danger').text("Uma falha ocorreu!");
          $('.alert-danger').show();
          setInterval(() => {
            $('.alert-danger').text("");
            $('.alert-danger').hide('close');
          }, 5000);
      }
  });
  }
}};
function favoritaSemUser(){
  
  $('.alert-warning').text("Apenas usuarios logados podem favoritar áreas");
  $('.alert-warning').show();
  setInterval(() => {
    $('.alert-warning').text("");
    $('.alert-warning').hide('close');
  }, 5000);
}
function alterarSenha(){
  var form = $('#form-altUserSenha').serialize();
  var senha = $('#senha').val()
  if(senha != ""){
    $.ajax({
      type:'POST',
      url:'../controller/alterarSenhaUsuario.php',
      dataType: "json",
      data: form,
      success: function(response){
        if(response == 1){
          alert('Alterado com sucesso!')
          window.location.href = "../view/confUser.php"
        }else if(response == 0){
          alert("Falha!");
        }else if(response == -1){
          alert("As senhas digitadas são diferentes");
        }
      },
      error: function(response){
        alert("erro2");
        console.log("erro"+response);
      }
    });
  }else{
    alert("Senha não pode ser vazia")
  }
}
$('#comentar').keypress(function(){
  if($('#comentar').val().length > 255){
    alert("Comentario pode ter até 255 caracteres");
  }
})
function comentar(){
  var regex = new RegExp("^[a-zA-Z0-9àèìòùáéíóúâêîôûãõ\b]+$");
  if(regex.test($('#comentario').val())){
  if(localArray[localArray.length - 1] == "profissoes.php"){
    var local = 'area';
  }else{
    var local = 'profissao';
  }
  var form = $('#comentar').serialize() + '&local=' + local;
  var comentario = $('#comentario').val();
  $.ajax({
    type:'POST',
    url:'../controller/comentar.php',
    dataType: "json",
    data: form,
    success: function(response){
      $('#comentario').val("");
      if(response == 1){
        $('#retorno').load("../controller/comentarioNovo.php", {
          comentario
        });
        $('.alert-success').text("Comentario adicionado");
        $('.alert-success').show();
        setInterval(() => {
          $('.alert-success').text("");
          $('.alert-success').hide('close');
        }, 5000);
      }else if(response == 0){
        $('.alert-warning').text("É preciso estar logado para comentar");
        $('.alert-warning').show();
        setInterval(() => {
          $('.alert-warning').text("");
          $('.alert-warning').hide('close');
        }, 5000);
      }else if(response == -1 || response == -2){
        $('.alert-danger').text("Erro");
        $('.alert-danger').show();
        setInterval(() => {
          $('.alert-danger').text("");
          $('.alert-danger').hide('close');
        }, 5000);
      }else if(response == -1 || response == -2){
        $('.alert-warning').text("O comentario não pode ter apenas espaços");
        $('.alert-warning').show();
        setInterval(() => {
          $('.alert-warning').text("");
          $('.alert-warning').hide('close');
        }, 5000);
      }
    },
    error: function(response){
      $('.alert-danger').text("erro "+response);
      $('.alert-danger').show();
      setInterval(() => {
        $('.alert-danger').text("");
        $('.alert-danger').hide('close');
      }, 5000);
    }
  });
  }else{
    $('.alert-warning').text("escreva algo para comentar");
    $('.alert-warning').show();
    setInterval(() => {
      $('.alert-warning').text("");
      $('.alert-warning').hide('close');
    }, 5000);
  }
}
function excluirComentario(valor){
  if(localArray[localArray.length - 1] == "profissoes.php"){
    var local = 'area';
  }else if(localArray[localArray.length - 1] == "cursos.php"){
    var local = 'profissao';
  }
  if(valor == -1){
    $('#retorno').text("");
  }else{
    var idComentario = valor;
  
  $.ajax({
    type:'POST',
    url:'../controller/excluirComentario.php',
    dataType: 'json',
    data: "id="+idComentario+"&local="+local,
    success: function(response){
      if(response == 1){
        window.location.href = window.location.href;
      }else if(response == 0){
        alert("falha!");
      }
    },
    error: function(response){
      alert("erro2");
      console.log("erro"+response);
    }
  });
}
}

function like(){
  if(localArray[localArray.length - 1] == "profissoes.php"){
    var local = 'area';
  }else if(localArray[localArray.length - 1] == "cursos.php"){
    var local = 'profissao';
  }
  $status = $('#like').attr("src");
  if($status == "../assets/img/like.png"){
    var like = 1;
  }else{
    var like = 0;
  }
  $.ajax({
    type:'POST',
    url:'../controller/avaliar.php',
    dataType: 'json',
    data: "like=" + like + "&local=" + local,
    success: function(response){
      if(response == 1){
        if(like == 0){
          $('#like').attr("src", "../assets/img/like.png");
        }else{
          $('#like').attr("src", "../assets/img/like_sel.png");
          $('#deslike').attr("src", "../assets/img/like.png");
        }
      }else{
        alert("falha!");
      }
    },
    error: function(response){
      alert("erro");
      console.log("erro"+response);
    }
  });
}
function deslike(){
  if(localArray[localArray.length - 1] == "profissoes.php"){
    var local = 'area';
  }else if(localArray[localArray.length - 1] == "cursos.php"){
    var local = 'profissao';
  }
  $status = $('#deslike').attr("src");
  if($status == "../assets/img/like.png"){
    var like = -1;
  }else{
    var like = 0;
  }
  $.ajax({
    type:'POST',
    url:'../controller/avaliar.php',
    dataType: 'json',
    data: "like=" + like + "&local=" + local,
    success: function(response){
      if(response == 1){
        if(like == 0){
          $('#deslike').attr("src", "../assets/img/like.png");
        }else{
          $('#deslike').attr("src", "../assets/img/like_sel.png");
          $('#like').attr("src", "../assets/img/like.png");
        }
      }else{
        alert("falha!");
      }
    },
    error: function(response){
      alert("erro");
      console.log("erro"+response);
    }
  });
}

function semUser(){
  $('.alert-warning').text("É preciso ser um usuário");
  $('.alert-warning').show();
  setInterval(() => {
    $('.alert-warning').text("");
    $('.alert-warning').hide('close');
  }, 5000);
}
function alterUser(){
  var regex = new RegExp("^[a-zA-Z0-9àèìòùáéíóúâêîôûãõ\b]+$");
}
function removeNotificacao(){
  $.ajax({
    type:'POST',
    url:'../controller/notificacaoVisualizada.php',
    dataType: 'json',
    data: 1,
    error: function(response){
      alert("erro");
      console.log("erro"+response);
    }
  });
}