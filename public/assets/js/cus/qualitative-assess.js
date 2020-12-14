    $(document).ready(function(){
        $(document).on('click', '.qualitativeAssessLauncher', function(e){
            $('#qualitativeAssessChangesBtn').hide();
        });
        $(document).on('click', '#qualitativeAssessBtn', function(e){
            e.preventDefault();
            var question = tinymce.get('qualitativeQuestion').getContent();
            if(question == ''){
                $.notify("Ooops! Kindly type question before submitting...", "error");
            }else{
                axios.post('/performance-indicator/qualitative', {
                    'question':question
                })
                .then(response=>{
                    $.notify(response.data.message, "success");
                    $("#qualitativeAssessmentTable").load(location.href + " #qualitativeAssessmentTable");
                    $('#qualitativeQuestionModal').modal('hide');
                })
                .catch(error=>{
                    $.notify("Ooops! Something went wrong. Try again.", "error");

                });
            }
        });

        $(document).on('click', '.qualitativeQuestionLauncherClass', function(e){
            $('#qualitativeAssessBtn').hide();
            $('#qualitativeAssessChangesBtn').show();
            var question = $(this).data('qualitative-question');
            var id = $(this).data('lid');
            tinymce.get("qualitativeQuestion").setContent(question);
            $('#qualitativeAssessChangesBtn').val(id);
        });

        $(document).on('click', '#qualitativeAssessChangesBtn', function(e){
            e.preventDefault();
            var id = $(this).val();
            var question = tinymce.get('qualitativeQuestion').getContent();
            if(question == ''){
                $.notify("Ooops! Kindly type question before submitting...", "error");
            }else{
                axios.post('/performance-indicator/qualitative/edit', {
                    'question':question,
                    'id':id
                })
                .then(response=>{
                    $.notify(response.data.message, "success");
                    $("#qualitativeAssessmentTable").load(location.href + " #qualitativeAssessmentTable");
                    $('#qualitativeQuestionModal').modal('hide');
                })
                .catch(error=>{
                    $.notify("Ooops! Something went wrong. Try again.", "error");

                });
            }
        });
    });