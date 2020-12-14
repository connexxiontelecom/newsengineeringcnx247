    $(document).ready(function(){
        $('.message-cus-preloader').hide(); //hide preloader
        $('.task-cus-preloader').hide(); //hide preloader
        $('.event-cus-preloader').hide(); //hide preloader
        $('.announcement-cus-preloader').hide(); //hide preloader
        $('.appreciation-cus-preloader').hide();
        $('.file-cus-preloader').hide(); //hide preloader
        $('.tabContentArea').hide(); //hide tabContentArea
        //processing files
        var message_attachments = null;
        var task_attachments = null;
        var announcement_attachments = null;
        var share_files = null;
        //process message attachment
        $('#message_attachments').change(function(event){
            var extension = $('#message_attachments').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']) == -1) {
                $.notify("Error! Please upload a supported file format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']", "error");
            }else{
                message_attachments = $('#message_attachments').prop('files')[0];

            }
        });
        /*
        *message all employee
        */
        $(document).on('click', '#message_all_employees', function(e){
            e.preventDefault();
            if($(this).is(":checked")){
                console.log("Checkbox is checked.");
            }
            else if($(this).is(":not(:checked)")){
                console.log("Checkbox is unchecked.");
            }
        });
        /*
        *send message
        */
        $(document).on('click', '#sendMessage', function(){
            form_data = new FormData;
            form_data.append('attachment', message_attachments);
            form_data.append('message_persons', JSON.stringify($('#message_persons').val()));
            form_data.append('message', tinyMCE.activeEditor.getContent());
            form_data.append('groupId', $('#uniqueWorkgroupId').val());
            $('.message-cus-preloader').show();
            $('#sendMessage').attr('disabled', 'disabled');
            axios.post('/workgroup/message', form_data)
            .then(response=>{
                $('.message-cus-preloader').hide();
                $('#sendMessage').removeAttr('disabled');
                location.reload();
            })
            .catch(error=>{

            });
        });

        //process task attachment
        $('#task_attachments').change(function(event){
            var extension = $('#task_attachments').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']) == -1) {
                $.notify("Error! Please upload a supported file format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']", "error");
                $('#task_attachments').val('');
            }else{
                task_attachments = $('#task_attachments').prop('files')[0];

            }
        });
        /*
        * Create task
        */
       $(document).on('click', '#submitTask', function(e){
           e.preventDefault();
           task_form = new FormData;
           task_form.append('task_title', $('#task_title').val());
           task_form.append('task_description', tinymce.get('task_description').getContent());
           task_form.append('due_date', $('#due_date').val());
           task_form.append('start_date', $('#start_date').val());
           task_form.append('attachment', task_attachments);
           task_form.append('responsible_persons', JSON.stringify($('#responsible_persons').val()));
           task_form.append('participants', JSON.stringify($('#participants').val()));
           task_form.append('observers', JSON.stringify($('#observers').val()));
           task_form.append('priority', $('#priority').val());
           task_form.append('status', $('#status').val());
           $('.task-cus-preloader').show();
            $('#submitTask').attr('disabled', 'disabled');
           axios.post('/task/new', task_form)
           .then(response=>{ //This task was created using the widget within activity stream
                $('.task-cus-preloader').hide();
                $('#submitTask').removeAtt('disabled');
           })
           .catch(error=>{

           });
       });

        /*
        *Expand tab content area
        */
         $(document).on('click', '.expandContent', function(){
            if($('.tabContentArea:visible').length){
                $('.tabContentArea').hide();
            }else{
                $('.tabContentArea').show();

            }
        });

        /*
        * Open/Close tabContentArea
        */
         $(document).on('click', '.toggleTab', function(e){

             if($('.tabContentArea:visible').length){
                $('.tabContentArea').hide();
            }else{
                $('.tabContentArea').show();

            }
        });
        /*
        * Create event
        */
       $(document).on('click', '#submitEvent', function(e){
           e.preventDefault();
           event_form = new FormData;
           event_form.append('event_name', $('#event_name').val());
           event_form.append('event_description', tinymce.get('event_description').getContent());
           event_form.append('event_end_date', $('#event_end_date').val());
           event_form.append('event_start_date', $('#event_start_date').val());
           event_form.append('attendees', JSON.stringify($('#attendees').val()));
           $('.event-cus-preloader').show();
            $('#submitEvent').attr('disabled', 'disabled');
           axios.post('/event/new', event_form)
           .then(response=>{ //This task was created using the widget within activity stream
                $('.event-cus-preloader').hide();
                $('#submitEvent').removeAttr('disabled');
           })
           .catch(error=>{

           });
       });
        //process announcement attachment
        $('#announcement_attachment').change(function(event){
            var extension = $('#announcement_attachment').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']) == -1) {
                $.notify("Error! Please upload a supported file format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']", "error");
                $('#announcement_attachment').val('');
            }else{
                announcement_attachments = $('#announcement_attachment').prop('files')[0];

            }
        });
        /*
        * Create announcement
        */
        $(document).on('click', '#submitAnnouncement', function(e){
           e.preventDefault();
           announcement_form = new FormData;
           announcement_form.append('subject', $('#subject').val());
           announcement_form.append('attachment', announcement_attachments);
           announcement_form.append('content', tinymce.get('announcement_text').getContent());
           announcement_form.append('to', JSON.stringify($('#announce_to').val()));
           $('.announcement-cus-preloader').show();
            $('#submitAnnouncement').attr('disabled', 'disabled');
           axios.post('/announcement/new', announcement_form)
           .then(response=>{ //This task was created using the widget within activity stream
                $('.announcement-cus-preloader').hide();
                $('#submitAnnouncement').removeAttr('disabled');
           })
           .catch(error=>{

           });
       });

        //process file sharing within activity stream
        $('#shareFile').change(function(event){
            var extension = $('#shareFile').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']) == -1) {
                $.notify("Error! Please upload a supported file format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']", "error");
                $('#shareFile').val('');
            }else{
                share_files = $('#shareFile').prop('files')[0];

            }
        });

        /*
        * Upload new file(s)
        */
        $(document).on('click', '#uploadFilesBtn', function(e){
           e.preventDefault();
           file_form = new FormData;
           file_form.append('attachment', share_files);
           file_form.append('share_with', JSON.stringify($('#share_with').val()));
           $('.file-cus-preloader').show();
            $('#uploadFilesBtn').attr('disabled', 'disabled');
           axios.post('/file/new', file_form)
           .then(response=>{
                $('.file-cus-preloader').hide();
                $('#uploadFilesBtn').removeAttr('disabled');
           })
           .catch(error=>{

           });
       });
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
           })
           .catch(error=>{

           });
       });

        /*
        * Send invitation by email
        */
        $(document).on('click', '#sendInvitationByEmail', function(e){
           e.preventDefault();
           invitation_form = new FormData;
           //app_form.append('emails', JSON.stringify($('#appreciating').val()));
           invitation_form.append('emails', JSON.stringify($('#invitation_emails').val()));
           invitation_form.append('message', $('#invitation_message').val());
           $('.invitation-cus-preloader').show();
            $('#sendInvitationByEmail').attr('disabled', 'disabled');
           axios.post('/invitation/email', invitation_form)
           .then(response=>{
                $('.invitation-cus-preloader').hide();
                $('#sendInvitationByEmail').removeAttr('disabled');
           })
           .catch(error=>{
                $('.invitation-cus-preloader').hide();
                $('#sendInvitationByEmail').removeAttr('disabled');
           });
       });

    });
