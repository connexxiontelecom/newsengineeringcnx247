$(document).ready(function(){
    $('.appreciation-cus-preloader').hide();
        /*
        * Create new appreciation
        */
       $(document).on('click', '#submitAppreciation', function(e){
        e.preventDefault();
        app_form = new FormData;
        app_form.append('content', tinymce.get('appreciation_text').getContent());
        app_form.append('persons', JSON.stringify($('#appreciating').val()));
        $('.appreciation-cus-preloader').show();
         $('#submitAppreciation').attr('disabled', 'disabled');
        axios.post('/appreciation/new', app_form)
        .then(response=>{
             $('.appreciation-cus-preloader').hide();
             $('#submitAppreciation').removeAttr('disabled');
             Toastify({
                text: "Success! Appreciation submitted.",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: 'right',
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
              }).showToast();
              location.reload();
        })
        .catch(error=>{
            $('.appreciation-cus-preloader').hide();
            $('#submitAppreciation').removeAttr('disabled');
            Toastify({
                text: "Ooops! Something went wrong.",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: 'right',
                backgroundColor: "linear-gradient(to right, #EE4E3D, #EE4E3D)",
              }).showToast();
              location.reload();
        });
    });
});
