@push('script')
  <script src="https://cdn.tiny.cloud/1/r2x614wq444nhjp96hcybcj4txrazg9tv299azbhyqtf3628/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    // tinymce.init({
    //   selector: 'textarea#desc',
    //   plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak image',
    //   toolbar_mode: 'floating',
    // });

    var editor_config = {
      path_absolute: "/",
      selector: 'textarea#desc',
      relative_urls: false,
      // plugins: [
      //   "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      //   "searchreplace wordcount visualblocks visualchars code fullscreen",
      //   "insertdatetime media nonbreaking save table directionality",
      //   "emoticons template paste textpattern"
      // ],
      plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',

      // toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      toolbar: 'fullscreen | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview save print | insertfile image media template link anchor codesample | ltr rtl',

      file_picker_callback: function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0]
          .clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[
          0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url: cmsURL,
          title: 'Filemanager',
          width: x * 0.8,
          height: y * 0.8,
          resizable: "yes",
          close_previous: "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    };

    tinymce.init(editor_config);
  </script>
@endpush
