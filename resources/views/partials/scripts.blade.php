<!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset('js/wz_jsgraphics.js') }}" type="text/javascript"></script>
<!-- jQuery 2.1.4 -->
<script src="{{ asset('plugins/jQuery/jQuery-2.2.0.min.js') }}"></script>

<script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>

<script src="//harshen.github.io/jquery-countdownTimer/jquery.countdownTimer.min.js"></script>

<script src="{{ asset('js/jquery.btree.js') }}" type="text/javascript"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>

<!-- Select2 -->
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<!-- Datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
<script src="{{ asset('js/clipboard.min.js') }}" type="text/javascript"></script>

<!-- bootstrap datepicker -->
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>


<script src="{{ asset('js/jquery.marquee.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('flag/assets/docs.js') }}" type="text/javascript"></script>




<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the/plugins/datepicker/bootstrap-datepicker.js
      fixed layout. -->
<script>
            $(function () {
            var clipboard = new Clipboard('.btn-copy-clipboard');
                    clipboard.on('success', function(e) {
                    alert("Copy Link Referer Successfully!");
                            e.clearSelection();
                    });
                    //Initialize Select2 Elements
                    $(".select2").select2();
                    //Datemask dd/mm/yyyy
                    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                    //Datemask2 mm/dd/yyyy
                    $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
                    //Money Euro
                    $("[data-mask]").inputmask();
                    //Date picker
                    $('#datepicker').datepicker({
            autoclose: true
            });
                    $(".notification-link").on("click", function () {
            if ($(this).data('type') == 3){
            $("#notificationModal .modal-title").text($(this).data('title'));
                    $("#notificationModal .modal-body").text($(this).data('content'));
                    $('#notificationModal').modal('show');
                    $.ajax({
                    url: $(this).data('href'),
                            dataType: 'json',
                            success: function (data) {

                            }
                    });
            }
            });
            });</script>

<script>
            function copySelectionText(){
            var copysuccess // var to check whether execCommand successfully executed
                    try{
                    copysuccess = document.execCommand("copy") // run command to copy selected text to clipboard
                    } catch (e){
            copysuccess = false
            }
            return copysuccess
            }

    function copyfieldvalue(e, id) {
    var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            var field = document.getElementById(id)
            field.focus();
            field.setSelectionRange(0, field.value.length);
            if (iOS){
    return;
    }
    var copysuccess = copySelectionText()
            if (copysuccess) {
    alert('Copy Link Referer Successfully!');
    }
    else{
    alert('Lỗi')
    }
    var selection = window.getSelection();
            if (selection.rangeCount > 0)
    {
    //clear current selection
    selection.removeAllRanges();
    }

    for (var i = 0; i < strongs.length; i++)
    {
    //loop over the items and add them to the selection object
    var range = document.createRange();
            range.selectNode(strongs[i]);
            selection.addRange(range);
    }
    }
</script>
