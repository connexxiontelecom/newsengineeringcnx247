
@push('query-script')
    <script>
        $(document).ready(function(){

/*             tinymce.init({
            selector: 'textarea',
            init_instance_callback: function (editor) {
                editor.on('blur', function (e) {
                    var data = tinymce.get("query-content").getContent();
                    @this.set('query_content', data);
                });
            }
            }); */
            tinymce.init({
  selector: 'textarea',
  init_instance_callback: function (editor) {
    editor.on('PreProcess', function (e) {
      console.log(e.node);
    });
  }
});


/*             $('#query-content').on('mouseleave', function(e){
                var data = tinymce.get("query-content").getContent();
                @this.set('query_content', data);
            }); */
        });
    </script>
@endpush
