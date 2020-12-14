  'use strict';

//const { default: Axios } = require("axios");

 $(document).ready(function() {

    /*display icon*/
    function setHeight() {
     var $window = $(window);
               if ($window.width() >= 991) {
            $('.contact-btn').css('display', 'none');
           $('.contact-box').addClass("contact-show");

        }
       else if($window.width() <= 768){

          $('.contact-btn').css('display', 'block');
               $('.contact-box').addClass("contact-hide");
          $('.contact-box').css('top', '100px');
        }
         else if($window.width() > 768 && $window.width() <= 990){

          $('.contact-btn').css('display', 'block');
               $('.contact-box').addClass("contact-hide");
          $('.contact-box').css('top', '50px');
        }
        else{
             $('.contact-btn').css('display', 'block');
               $('.contact-box').addClass("contact-hide");

      }
    };
        $(window).on('resize',function() {
            setHeight();
        });
    setHeight();
    //share attachment in chat
    $(document).on('click', '#shareAttachment', function(e){
        var config = {
            onUploadProgress: function(progressEvent) {
            var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                    }
            };
        $('#chatAttachment').click();
        $('#chatAttachment').change(function(event){
            var extension = $('#chatAttachment').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'jpeg', 'jpg', 'png', 'ppt']) == -1) {
                $.notify('Error! Please upload a valid file', 'error');
            }else{
                var attachment = '';
                attachment = $('#chatAttachment').prop('files')[0];
                var form_data = new FormData();
                form_data.append('attachment',attachment);
                form_data.append('to',25);
                console.log('Level');
                 axios.post('/conversation/attachment', form_data, config)
                .then(response=>{

                })
                .catch(error=>{

                });

            }
           });
/*         $('#chatAttachment').change(function(e){
            let file = e.target.files[0];
            let reader = new FileReader();
            var attachment='';
            reader.onloadend = (file) =>{
                attachment = reader.result;
                //$('#logo-preview').attr('src', logo);
                console.log('File chosen');
                axios.post('/conversation/attachment', {to:25, attachment:attachment})
                .then(response=>{

                })
                .catch(error=>{

                });
            }
            reader.readAsDataURL(file);

        }); */
    });
     /*Click on contact button icon*/
/*             $(".contact-wrapper").on('click',function() {
                var receiver = $(this).attr('id');

                    if($('.contact-box').hasClass("contact-show") == true){

                         $('.contact-box').removeClass("contact-show");
                        $('.contact-box').addClass("contact-hide");
                   }
                   else{

                    $('.contact-box').removeClass("contact-hide");
                       $('.contact-box').addClass("contact-show");
                   }
                   alert(receiver);
            }); */
  });
