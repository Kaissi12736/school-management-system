<!-- JQuery -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>


<!-- Plugins -->
<script src="{{ asset('assets/js/plugins-jquery.js') }}"></script>
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- Bootstrap Select -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script> --}}




<!-- Notifications -->
<script src="{{ asset('assets/js/notify.min.js') }}"></script>

<!-- Translations -->
<script>
    const translations = {
        confirmDeleteTitle: "{{ __('main_trans.confirm_delete_title') }}",
        confirmDeleteText: "{{ __('main_trans.confirm_delete_text') }}",
        confirmButton: "{{ __('main_trans.confirm_button') }}",
        cancelButton: "{{ __('main_trans.cancel_button') }}",
        successTitle: "{{ __('main_trans.success_title') }}",
        successMessage: "{{ __('main_trans.success_message') }}",
        editGradeTitle: "{{ __('main_trans.edit_Grade') }}",
        stageNameAr: "{{ __('main_trans.stage_name_ar') }}",
        stageNameEn: "{{ __('main_trans.stage_name_en') }}",
        notesLabel: "{{ __('main_trans.Notes') }}",
        saveChanges: "{{ __('main_trans.save_changes') }}",
        validationMessage: "{{ __('main_trans.validation_message') }}",
        addGradeTitle: "{{ __('main_trans.add_Grade') }}",
    };
</script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Grades JS -->
<script src="{{ asset('assets/js/grades.js') }}"></script>

<!-- DataTables -->
@if (App::getLocale() == 'en')
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/en/dataTables.bootstrap4.min.js') }}"></script>
@else
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datatables/ar/dataTables.bootstrap4.min.js') }}"></script>
@endif

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>

<!-- Additional JS -->
<script src="{{ asset('assets/js/chart-init.js') }}"></script>
<script src="{{ asset('assets/js/calendar.init.js') }}"></script>
<script src="{{ asset('assets/js/sparkline.init.js') }}"></script>
<script src="{{ asset('assets/js/morris.init.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/validation.js') }}"></script>
<script src="{{ asset('assets/js/lobilist.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

@yield('js')

<!-- Check All Function -->
<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
</script>