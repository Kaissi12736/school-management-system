@extends('layouts.master')
@section('css')
    {{-- @notifyCss --}}


@section('title')
    {{ trans('Grades_trans.title_page') }}
@stop
@endsection

{{-- <x-notify::notify class="notify animate__animated animate__slideInDown" /> --}}



@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Grades') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
{{-- @if (session()->has('delete_grade'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('delete_grade') }}'
        });
    </script>
@endif --}}
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="formAddGrade" action="{{ route('Grades.store') }}" method="post" style="display: inline;">
                    @csrf
                    <input type="hidden" name="Name" value="">
                    <input type="hidden" name="Name_en" value="">
                    <input type="hidden" name="Notes" value="">
                    <button type="button" class="btn btn-success btn-lg" onclick="addGrade()">
                        <i class="fa fa-plus"></i> {{ trans('Grades_trans.add_Grade') }}
                    </button>
                </form>
                
                
                {{-- <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Grades_trans.add_Grade') }}
                </button> --}}
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Grades_trans.Name') }}</th>
                                <th>{{ trans('Grades_trans.Notes') }}</th>
                                <th>{{ trans('Grades_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($Grades as $Grade)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $Grade->Name }}</td>
                                    <td>{{ $Grade->Notes }}</td>
                                    <td>
                                        <form id="formEdit{{ $Grade->id }}" action="{{ route('Grades.update', 'test') }}" method="post" style="display: inline;">
                                            @csrf
                                            {{ method_field('PATCH') }}
                                            <input type="hidden" name="id" value="{{ $Grade->id }}">
                                            <input type="hidden" name="Name" value="{{ $Grade->getTranslation('Name', 'ar') }}">
                                            <input type="hidden" name="Name_en" value="{{ $Grade->getTranslation('Name', 'en') }}">
                                            <input type="hidden" name="Notes" value="{{ $Grade->Notes }}">
                                            <button type="button" class="btn btn-info btn-sm" onclick="editGrade(event, {{ $Grade->id }})">
                                                <i class="fa fa-edit"></i> {{ trans('Grades_trans.Edit') }}
                                            </button>
                                        </form>
                                        
                                    <!-- زر حذف الصف -->
<form id="formExlu{{ $Grade->id }}" action="{{ route('Grades.destroy', 'test') }}" method="post" style="display: inline;">
    @csrf
    {{ method_field('DELETE') }}
    <input type="hidden" name="id" value="{{ $Grade->id }}">
    <button type="button" class="btn btn-danger btn-sm" onclick="confirmation(event, {{ $Grade->id }})">
        <i class="fa fa-trash"></i> {{ trans('Grades_trans.Delete') }}
    </button>
</form>
                                    </td>
                                </tr>

                                {{-- <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $Grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('Grades_trans.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('Grades.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="Name"
                                                                class="form-control"
                                                                value="{{ $Grade->getTranslation('Name', 'ar') }}"
                                                                required>
                                                            <input id="id" type="hidden" name="id"
                                                                class="form-control" value="{{ $Grade->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $Grade->getTranslation('Name', 'en') }}"
                                                                name="Name_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3">{{ $Grade->Notes }}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form id="formExlu{{ $Grade->id }}"
                                                    action="{{ route('Grades.destroy', 'test') }}" method="post">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $Grade->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="confirmation(event, {{ $Grade->id }})">
                                                            {{ trans('Grades_trans.submit') }}
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- add_modal_Grade -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('Grades_trans.add_Grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('Grades.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                    :</label>
                                <input id="Name" type="text" name="Name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" name="Name_en" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                :</label>
                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                </div>
                </form>

            </div>
        </div>
    </div>

</div>

<!-- row closed -->
@endsection
@section('js')

<script>



    // function confirmation(event, gradeId) {
    //     event.preventDefault(); // منع الإرسال الفوري للنموذج
    //     Swal.fire({
    //         title: "{{ __('Grades_trans.confirm_delete_title') }}",
    //         text: "{{ __('Grades_trans.confirm_delete_text') }}", // ترجمة النص التوضيحي
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonColor: "#3085d6",
    //     cancelButtonColor: "#d33",
    //     confirmButtonText: "{{ __('Grades_trans.confirm_button') }}", // ترجمة نص زر التأكيد
    //     cancelButtonText: "{{ __('Grades_trans.cancel_button') }}", // ترجمة نص زر الإلغاء
    // }).then((result) => {
    //         if (result.isConfirmed) {
    //             // إرسال النموذج إذا تم تأكيد الحذف
    //             document.getElementById(`formExlu${gradeId}`).submit();
    //             Swal.fire({
    //     title: "تم الحذف!",
    //     text: "تم حذف العنصر بنجاح.",
    //     icon: "success",
    //     timer: 10000, // المدة الزمنية قبل الإغلاق (4000 مللي ثانية = 4 ثوانٍ)
    //     timerProgressBar: false, // إظهار شريط تقدم
    //     showConfirmButton: false, // عدم عرض زر التأكيد
    //     willClose: () => {
    //         // هذا الخيار يتم تنفيذه عند إغلاق النافذة
    //         console.log('تم إغلاق نافذة النجاح');
    //     }
    // });
    //         }
    //     });
    // }



   
//     function editGrade(event, gradeId) {
//     event.preventDefault(); // منع الإرسال الفوري للنموذج

//     // جلب النموذج
//     const form = document.getElementById(`formEdit${gradeId}`);
//     const nameAr = form.querySelector('input[name="Name"]').value || ''; // التحقق من وجود القيمة
//     const nameEn = form.querySelector('input[name="Name_en"]').value || ''; // التحقق من وجود القيمة
//     const notes = form.querySelector('input[name="Notes"]').value || ''; // التحقق من وجود القيمة

//     // نافذة SweetAlert2 لتحرير البيانات
//     Swal.fire({
//         title: "{{ __('Grades_trans.edit_Grade') }}", // الترجمة من ملف اللغة
//         html: `
//             <form id="editForm">
//                 <div class="form-group text-left">
//                     <label>{{ __('Grades_trans.stage_name_ar') }}:</label>
//                     <input type="text" id="editNameAr" class="form-control" value="${nameAr}" required>
//                 </div>
//                 <div class="form-group text-left">
//                     <label>{{ __('Grades_trans.stage_name_en') }}:</label>
//                     <input type="text" id="editNameEn" class="form-control" value="${nameEn}" required>
//                 </div>
//                 <div class="form-group text-left">
//                     <label>{{ __('Grades_trans.Notes') }}:</label>
//                     <textarea id="editNotes" class="form-control" rows="3" required>${notes}</textarea>
//                 </div>
//             </form>
//         `,
//         showCancelButton: true,
//         confirmButtonText: "{{ __('Grades_trans.save_changes') }}", // نص زر الحفظ
//         cancelButtonText: "{{ __('Grades_trans.Close') }}", // نص زر الإلغاء
//         focusConfirm: false,
//         preConfirm: () => {
//             const newNameAr = document.getElementById('editNameAr').value;
//             const newNameEn = document.getElementById('editNameEn').value;
//             const newNotes = document.getElementById('editNotes').value;

//             if (!newNameAr || !newNameEn || !newNotes) {
//                 Swal.showValidationMessage("{{ __('Grades_trans.validation_message') }}"); // رسالة التحقق
//                 return false;
//             }

//             // تحديث القيم داخل النموذج المخفي
//             form.querySelector('input[name="Name"]').value = newNameAr;
//             form.querySelector('input[name="Name_en"]').value = newNameEn;
//             form.querySelector('input[name="Notes"]').value = newNotes;

//             // إرسال النموذج
//             form.submit();
//         }
//     });
// }


// اضافة الصف الدراسي  
// function addGrade() {
//     Swal.fire({
//         title: "{{ __('Grades_trans.add_Grade') }}", // الترجمة من ملف اللغة
//         html: `
//             <form id="addForm">
//                 <div class="form-group text-left">
//                     <label>{{ __('Grades_trans.stage_name_ar') }}:</label>
//                     <input type="text" id="addNameAr" class="form-control" required>
//                 </div>
//                 <div class="form-group text-left">
//                     <label>{{ __('Grades_trans.stage_name_en') }}:</label>
//                     <input type="text" id="addNameEn" class="form-control" required>
//                 </div>
//                 <div class="form-group text-left">
//                     <label>{{ __('Grades_trans.Notes') }}:</label>
//                     <textarea id="addNotes" class="form-control" rows="3" required></textarea>
//                 </div>
//             </form>
//         `,
//         showCancelButton: true,
//         confirmButtonText: "{{ __('Grades_trans.submit') }}", // نص زر الإضافة
//         cancelButtonText: "{{ __('Grades_trans.Close') }}", // نص زر الإلغاء
//         focusConfirm: false,
//         preConfirm: () => {
//             const nameAr = document.getElementById('addNameAr').value;
//             const nameEn = document.getElementById('addNameEn').value;
//             const notes = document.getElementById('addNotes').value;

//             if (!nameAr || !nameEn || !notes) {
//                 Swal.showValidationMessage("{{ __('Grades_trans.validation_message') }}"); // رسالة التحقق
//                 return false;
//             }

//             // تحديث القيم داخل النموذج المخفي
//             const form = document.getElementById('formAddGrade');
//             form.querySelector('input[name="Name"]').value = nameAr;
//             form.querySelector('input[name="Name_en"]').value = nameEn;
//             form.querySelector('input[name="Notes"]').value = notes;

//             // إرسال النموذج
//             form.submit();
//         }
//     });
// }


</script>

@endsection

