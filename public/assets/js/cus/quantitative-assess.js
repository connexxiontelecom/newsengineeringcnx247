    $(document).ready(function(){
        $(document).on('click', '.quantitativeAssessLauncher', function(e){
            $('#quantitativeAssessChangesBtn').hide();
        });
        $(document).on('click', '#quantitativeAssessBtn', function(e){
            e.preventDefault();
            var question = tinymce.get('quantitativeQuestion').getContent();
            if(question == ''){
                $.notify("Ooops! Kindly type question before submitting...", "error");
            }else{
                axios.post('/performance-indicator/quantitative', {
                    question:question,
                    role:$('#roleId').val()
                })
                .then(response=>{
                    $.notify(response.data.message, "success");
                    $("#quantitativeAssessmentTable").load(location.href + " #quantitativeAssessmentTable");
                    $('#quantitativeQuestionModal').modal('hide');
                })
                .catch(error=>{
                    $.notify("Ooops! Something went wrong. Try again.", "error");

                });
            }
        });

        $(document).on('click', '.quantitativeQuestionLauncherClass', function(e){
            $('#quantitativeAssessBtn').hide();
            $('#quantitativeAssessChangesBtn').show();
            var question = $(this).data('quantitative-question');
            var id = $(this).data('qqid');
            tinymce.get("quantitativeQuestion").setContent(question);
            $('#quantitativeAssessChangesBtn').val(id);
        });

        $(document).on('click', '#quantitativeAssessChangesBtn', function(e){
            e.preventDefault();
            var id = $(this).val();
            var question = tinymce.get('quantitativeQuestion').getContent();
            if(question == ''){
                $.notify("Ooops! Kindly type question before submitting...", "error");
            }else{
                axios.post('/performance-indicator/quantitative/edit', {
                    'question':question,
                    'id':id
                })
                .then(response=>{
                    $.notify(response.data.message, "success");
                    $("#quantitativeAssessmentTable").load(location.href + " #quantitativeAssessmentTable");
                    $('#quantitativeQuestionModal').modal('hide');
                })
                .catch(error=>{
                    $.notify("Ooops! Something went wrong. Try again.", "error");

                });
            }
        });
    });
