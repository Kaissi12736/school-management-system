<!-- JQuery -->
<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>


<!-- Plugins -->
<script src="{{ asset('assets/js/plugins-jquery.js') }}"></script>
<script type="text/javascript">
    var plugin_path = '{{ asset('assets/js') }}/';
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<!-- سكريبتات Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-pzjw8f+ua7Kw1TIqj8mOnyZ2mbz4YiCWj4f9Xj3jtMp4ylr60CmDXm9uBoqKbFVm" crossorigin="anonymous">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

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






<script>
    $(document).ready(function () {
        $('select[name="Classroom_id"]').on('change', function () {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>






<script>
    $(document).ready(function () {
        $('select[name="Grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="Classroom_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>








<script>
    $(document).ready(function () {
        $('select[name="Grade_id_new"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="Classroom_id_new"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="Classroom_id_new"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $('select[name="Classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('select[name="Classroom_id_new"]').on('change', function () {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id_new"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
