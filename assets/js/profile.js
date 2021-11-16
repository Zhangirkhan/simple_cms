//Профили
$(function () {
    $(".flatpickr").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        locale: "ru",
    });
   

   //Загрузка файлов 
   var bar = $('.bar');
   var percent = $('.percent');
   var status = $('#status');

   $('#uploadForm').ajaxForm({
       beforeSend: function () {
           $('.progress').show();
           var percentVal = '0%';
           bar.width(percentVal)
           percent.html(percentVal);
       },
       uploadProgress: function (event, position, total, percentComplete) {
           var percentVal = percentComplete + '%';
           bar.width(percentVal)
           percent.html(percentVal);
       },
       success: function () {
           var percentVal = '100%';
           bar.width(percentVal)
           percent.html(percentVal);
       },
       complete: function (xhr) {
           //status.html(xhr.responseText);
           window.location.reload();
       }

   });

});