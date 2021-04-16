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
if(localArray[localArray.length - 1] == "cadastro.php"){
  form = document.getElementById('form-cadastro');
} else if(localArray[localArray.length - 1] == "entra.php"){
  form = document.getElementById('form-login');
}else if(localArray[localArray.length - 1] == "entra.php"){
  form = document.getElementById('form-area');
}
form.addEventListener('submit', e => {
    e.preventDefault()
    console.log('Deu certo')
})
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
          if(response == -2){
            alert("As senhas digitadas não são iguais");
          }else if(response == -1){
            alert("Falha ao cadastrar, tente novamente ou entre em contato com o suporte do site");
          }else if(response == 0){
            alert("Email já cadastrado no site");
          }else if(response == 1){
            console.log(response);
            window.location.href = "../view/areaUsuario.php";
          }
        },
        error: function(response){
          alert("erro");
          console.log("erro"+response);
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
          window.location.href = "../view/areaAdm.php";
        }
      },
      error: function(response){
          console.log("erro"+response);
      }
  });
};
function cadastrarArea(){
    var form = $('#form-area').serialize();
    console.log(form);
    $.ajax({
        type:'POST',
        url:'../controller/cadastrarArea.php',
        dataType: "json",
        data: form,
        success: function(response){
          if(response == 1){
            alert("cadastrado com sucesso!");
          }else if(response == 0){
            alert("Falha ao cadastrar, tente novamente");
          }
        },
        error: function(response){
          alert("erro");
          console.log("erro"+response);
        }
    });
};