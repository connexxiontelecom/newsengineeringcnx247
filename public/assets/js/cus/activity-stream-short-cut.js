    $(document).ready(function(){
        $('.message-cus-preloader').hide(); //hide preloader
        $('.task-cus-preloader').hide(); //hide preloader
        $('.event-cus-preloader').hide(); //hide preloader
        $('.announcement-cus-preloader').hide(); //hide preloader
        $('.appreciation-cus-preloader').hide();
        $('.file-cus-preloader').hide(); //hide preloader
        $('.tabContentArea').hide(); //hide tabContentArea
        $('#message-persons-wrap').hide();
        $('#event-persons-wrap').hide();
        $('#announcement-persons-wrap').hide();
        $('#file-persons-wrap').hide();
        $('#appreciating-persons-wrap').hide();
        //processing files
        var message_attachments = null;
        var task_attachments = null;
        var announcement_attachments = null;
        var share_files = null;
        //process message attachment
        $('#message_attachments').change(function(event){
            var extension = $('#message_attachments').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif','ppt', 'pptx']) == -1) {
                $.notify("Error! Please upload a supported file format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']", "error");
            }else{
                message_attachments = $('#message_attachments').prop('files')[0];

            }
        });
        /*
        *message all employee
        */
        $(document).on('change', '#target_message', function(e){
            e.preventDefault();
            if($(this).val() == 1){
                $('#message-persons-wrap').show();
            }else{
                $('#message-persons-wrap').hide();
            }
        });
        $(document).on('change', '#target_announcement', function(e){
            e.preventDefault();
            if($(this).val() == 1){
                $('#announcement-persons-wrap').show();
            }else{
                $('#announcement-persons-wrap').hide();
            }
        });
        $(document).on('change', '#target_file', function(e){
            e.preventDefault();
            if($(this).val() == 1){
                $('#file-persons-wrap').show();
            }else{
                $('#file-persons-wrap').hide();
            }
        });
        $(document).on('change', '#target_appreciating', function(e){
            e.preventDefault();
            if($(this).val() == 1){
                $('#appreciating-persons-wrap').show();
            }else{
                $('#appreciating-persons-wrap').hide();
            }
        });
        /*
        *send message
        */
       $('#messageForm').parsley().on('field:validated', function() {


        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };

                form_data = new FormData;
                form_data.append('attachment', message_attachments);
                form_data.append('target', $('#target_message').val());
                form_data.append('message_persons', JSON.stringify($('#message_persons').val()));
                form_data.append('message', tinymce.get('compose_message').getContent());
                $('.message-cus-preloader').show();
                $('#sendMessage').attr('disabled', 'disabled');
                axios.post('/activity-stream/message', form_data)
                .then(response=>{
                    $('.message-cus-preloader').hide();
                    $('#sendMessage').removeAttr('disabled');
                    $.notify(response.data.message, "success");
                    location.reload();
                })
                .catch(error=>{
                    var errs = Object.values(error.response.data.errors);
                    $.notify(errs, "error");
                    $('.message-cus-preloader').hide();
                    $('#sendMessage').removeAttr('disabled');
                });
                return false;
        });

        $(document).on('mouseover', '.rollover', function(e){
            axios.post('/activity-stream/live-update', {live:$(this).data('live')});
        });

        //process task attachment
        $('#task_attachments').change(function(event){
            var extension = $('#task_attachments').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif','ppt', 'pptx']) == -1) {
                $.notify("Error! Please upload a supported file format: ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif']", "error");
                $('#task_attachments').val('');
            }else{
                task_attachments = $('#task_attachments').prop('files')[0];

            }
        });
        /*
        * Create task
        */
       $('#taskForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };

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
            axios.post('/activity-stream/new/task', task_form)
            .then(response=>{
                 $('.task-cus-preloader').hide();
                 $('#submitTask').removeAttr('disabled');
                 $.notify(response.data.message, "success");
                 location.reload();
            })
            .catch(error=>{
                var errs = Object.values(error.response.data.errors);
                $.notify(errs, "error");
                $('.task-cus-preloader').hide();
                $('#submitTask').removeAttr('disabled');
            });
            return false;
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

        $(document).on('change', '#target_event', function(e){
            e.preventDefault();
            if($(this).val() == 1){
                $('#event-persons-wrap').show();
            }else{
                $('#event-persons-wrap').hide();
            }
        });
        /*
        * Create event
        */

       $('#eventForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
           var config = {
                    onUploadProgress: function(progressEvent) {
                    var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                    }
            };
            event_form = new FormData;
            event_form.append('event_name', $('#event_name').val());
            event_form.append('event_description', tinymce.get('event_description').getContent());
            event_form.append('event_end_date', $('#event_end_date').val());
            event_form.append('event_start_date', $('#event_start_date').val());
            event_form.append('target', $('#target_event').val());
            event_form.append('attendees', JSON.stringify($('#attendees').val()));
            $('.event-cus-preloader').show();
             $('#submitEvent').attr('disabled', 'disabled');
             axios.post('/event/new', event_form)
            .then(response=>{
                 $('.event-cus-preloader').hide();
                 $('#submitEvent').removeAttr('disabled');
                 $.notify(response.data.message, "success");
                 location.reload();
            })
            .catch(error=>{
                var errs = Object.values(error.response.data.errors);
                $.notify(errs, "error");
                $('.event-cus-preloader').hide();
                $('#submitEvent').removeAttr('disabled');
            });
            return false;
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
       $('#announcementForm').parsley().on('field:validated', function() {


    }).on('form:submit', function() {
        var config = {
                    onUploadProgress: function(progressEvent) {
                    var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                    }
            };
                announcement_form = new FormData;
                announcement_form.append('subject', $('#subject').val());
                announcement_form.append('attachment', announcement_attachments);
                announcement_form.append('target', $('#target_announcement').val());
                announcement_form.append('content', tinymce.get('announcement_text').getContent());
                announcement_form.append('to', JSON.stringify($('#announce_to').val()));
                $('.announcement-cus-preloader').show();
                $('#submitAnnouncement').attr('disabled', 'disabled');
                axios.post('/announcement/new', announcement_form)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('.announcement-cus-preloader').hide();
                    $('#submitAnnouncement').removeAttr('disabled');
                    location.reload();
                })
                .catch(error=>{
                    var errs = Object.values(error.response.data.errors);
                    $.notify(errs, "error");
                    $('#submitAnnouncement').removeAttr('disabled');
                    $('.announcement-cus-preloader').hide();
                });
            return false;
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
       $('#fileUploadForm').parsley().on('field:validated', function() {


    }).on('form:submit', function() {
        var config = {
                    onUploadProgress: function(progressEvent) {
                    var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                    }
            };
                file_form = new FormData;
                file_form.append('file_name', $('#fileName').val());
                file_form.append('attachment', share_files);
                file_form.append('target', $('#target_file').val());
                file_form.append('share_with', JSON.stringify($('#share_with').val()));
                $('.file-cus-preloader').show();
                $('#uploadFilesBtn').attr('disabled', 'disabled');
                axios.post('/activity-stream/upload/attachment', file_form)
                .then(response=>{
                    $('.file-cus-preloader').hide();
                    $('#uploadFilesBtn').removeAttr('disabled');
                    $.notify(response.data.message, 'success');
                    location.reload();
                })
                .catch(error=>{
                    var errs = Object.values(error.response.data.errors);
                    $.notify(errs, "error");
                    $('.file-cus-preloader').hide();
                    $('#uploadFilesBtn').removeAttr('disabled');
                });
            return false;
        });

        /*
        * Create new appreciation
        */
       $('#appreciationForm').parsley().on('field:validated', function() {
    }).on('form:submit', function() {
        var config = {
                    onUploadProgress: function(progressEvent) {
                    var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                    }
            };
            app_form = new FormData;
            app_form.append('content', tinymce.get('appreciation_text').getContent());
            app_form.append('persons', JSON.stringify($('#appreciating').val()));
            app_form.append('target', $('#target_appreciating').val());
            $('.appreciation-cus-preloader').show();
             $('#submitAppreciation').attr('disabled', 'disabled');
            axios.post('/appreciation/new', app_form)
            .then(response=>{
                 $('.appreciation-cus-preloader').hide();
                 $('#submitAppreciation').removeAttr('disabled');
                 $.notify(response.data.message, 'success');
                 location.reload();
            })
            .catch(error=>{
                var errs = Object.values(error.response.data.errors);
                $.notify(errs, "error");
                $('.appreciation-cus-preloader').hide();
                $('#submitAppreciation').removeAttr('disabled');
            });
            return false;
        });

        /*
        * Send invitation by email
        */
       $('#invitationDialogForm').parsley().on('field:validated', function() {


        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                invitation_form = new FormData;
                invitation_form.append('first_name', $('#invitation_first_name').val());
                invitation_form.append('email', $('#invitation_email').val());
                invitation_form.append('message', $('#invitation_message').val());
                $('.invitation-cus-preloader').show();
                 $('#sendInvitationByEmail').attr('disabled', 'disabled');
                axios.post('/invitation/email', invitation_form)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                     $('.invitation-cus-preloader').hide();
                     $('#sendInvitationByEmail').removeAttr('disabled');
                })
                .catch(error=>{
                    var errs = Object.values(error.response.data.errors);
                    $.notify(errs, "error");
                     $('.invitation-cus-preloader').hide();
                     $('#sendInvitationByEmail').removeAttr('disabled');
                });
                return false;
            });

    });
