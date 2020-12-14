    $(document).ready(function(){
        $(document).on('click', '.selfAssessLauncher', function(e){
            $('#selfAssessChangesBtn').hide();
        });
        $(document).on('click', '#selfAssessBtn', function(e){
            e.preventDefault();
            var question = tinymce.get('selfQuestion').getContent();
            if(question == ''){
                $.notify("Ooops! Kindly type question before submitting...", "error");
            }else{
                axios.post('/performance-indicator/self', {
                    'question':question
                })
                .then(response=>{
                    $.notify(response.data.message, "success");
                    $("#selfAssessmentTable").load(location.href + " #selfAssessmentTable");
                    $('#selfQuestionModal').modal('hide');
                })
                .catch(error=>{
                    $.notify("Ooops! Something went wrong. Try again.", "error");

                });
            }
        });

        $(document).on('click', '.selfQuestionLauncherClass', function(e){
            $('#selfAssessBtn').hide();
            $('#selfAssessChangesBtn').show();
            var question = $(this).data('self-question');
            var id = $(this).data('sqid');
            tinymce.get("selfQuestion").setContent(question);
            $('#selfAssessChangesBtn').val(id);
        });

        $(document).on('click', '#selfAssessChangesBtn', function(e){
            e.preventDefault();
            var id = $(this).val();
            var question = tinymce.get('selfQuestion').getContent();
            if(question == ''){
                $.notify("Ooops! Kindly type question before submitting...", "error");
            }else{
                axios.post('/performance-indicator/self/edit', {
                    'question':question,
                    'id':id
                })
                .then(response=>{
                    $.notify(response.data.message, "success");
                    $("#selfAssessmentTable").load(location.href + " #selfAssessmentTable");
                    $('#selfQuestionModal').modal('hide');
                })
                .catch(error=>{
                    $.notify("Ooops! Something went wrong. Try again.", "error");

                });
            }
        });
    });
