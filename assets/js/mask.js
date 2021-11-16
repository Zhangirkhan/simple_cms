$(function () {
    'use strict'
  //Script
    // Input Masks
   // $('#dateMask').mask('99/99/9999');
    
    //Решение проблемы с кликом по центру
    $.fn.setCursorPosition = function(pos) {
        if ($(this).get(0).setSelectionRange) {
          $(this).get(0).setSelectionRange(pos, pos);
        } else if ($(this).get(0).createTextRange) {
          var range = $(this).get(0).createTextRange();
          range.collapse(true);
          range.moveEnd('character', pos);
          range.moveStart('character', pos);
          range.select();
        }
      };


    $("#phoneMask").click(function(){
        $(this).setCursorPosition(2);
      }).mask('+79999999999');
      
      $("#emailMask").inputmask("email");
      // $("#emailMask").click(function(){
      //   $(this).setCursorPosition(1);
      // }).inputmask({
      //   regex: "^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+.[A-Za-z]+$",
      //   placeholder: "Введите номер телефона"
      // });
   // $('#mail').mask('999-99-9999');
      

  });
  