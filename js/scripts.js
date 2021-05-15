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
function cadastrar(){
  if(verifica()){
    var form = $('#form-cadastro').serialize();
    console.log(form);
    $.ajax({
        type:'POST',
        url:'../controller/cadastrarUsuario.php',
        dataType: "json",
        data: form,
        success: function(response){
          if(response['retorno'] == -2){
            alert("As senhas digitadas não são iguais");
          }else if(response['retorno'] == -1){
            alert("Falha ao cadastrar, tente novamente ou entre em contato com o suporte do site");
          }else if(response['retorno'] == 0){
            alert("Email já cadastrado no site");
          }else if(response['retorno'] == 1){
            console.log(response['retorno']);
            window.location.href = "../view/areaUsuario.php";
          }
        },
        error: function(response){
          alert("erro");
          console.log("erro"+response['retorno']);
        }
    });
  }else{}
};
function checarEmail(){
  if($('#email').val()=="" || $('#email').val().indexOf('@')==-1 || $('#email').val().indexOf('.')==-1){
    alert("Por favor, informe um E-MAIL válido!");
    return false;
  }
}
function verifica() {
  if($('#email').val() == ''){
    alert('Por favor, informe o seu EMAIL.');
    $('#email').focus();
    return false;
  }else if($('#nome').val() == ''){
    alert('Por favor, informe o seu NOME DE USUÁRIO.');
    $('#nome').focus();
    return false;
  }else if($('#senha').val() == ''){
    alert('Por favor, informe o sua SENHA.');
    $('#senha').focus();
    return false;
  }else if($('#confSenha').val() == ''){
    alert('Por favor, Preencha o campo CONFIRMAR SENHA.');
    $('#confSenha').focus();
    return false;
  }
  return true;
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
          alert("Email ou senha incorretos");
        } else if(response == -2 || response == -3 || response == 0){
          alert("Falha no login, tente novamente ou entre em contato");
        } else if(response == 2){
          console.log(response);
          window.location.href = "../view/adm-dashboard.php";
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
          }else if(response == 0){
            alert("Falha ao cadastrar, tente novamente");
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
        }else if(response == 0){
          alert("Falha!");
        }else if(response == -1){
          alert("Falha!");
        }
      },
      error: function(response){
        alert("erro2");
        console.log("erro"+response);
      }
  });
  }
}};
function favoritaSemUser(){
  alert("Apenas usuarios logados podem favoritar áreas");
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

function comentar(){
  if(localArray[localArray.length - 1] == "profissoes.php"){
    var local = 'area';
  }else{
    var local = 'profissao';
  }
  var form = $('#comentar').serialize() + '&local=' + local;
  $.ajax({
    type:'POST',
    url:'../controller/comentar.php',
    dataType: "json",
    data: form,
    success: function(response){
      if(response == 1){
        window.location.href = window.location.href;
      }else if(response == 0){
        alert("É preciso estar logado para comentar");
      }else if(response == -1){
        alert("Erro");
      }
    },
    error: function(response){
      alert("erro2");
      console.log("erro"+response);
    }
  });
}
function excluirComentario(){
  if(localArray[localArray.length - 1] == "profissoes.php"){
    var local = 'area';
  }else if(localArray[localArray.length - 1] == "cursos.php"){
    var local = 'profissao';
  }
  var idComentario = $('#comentarioId').val();
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
