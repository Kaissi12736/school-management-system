@extends('layouts.master')
@section('css')
 

@section('title')
    {{ trans('Grades_trans.title_page') }}
@stop
@endsection





@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Grades') }}
@stop
<!-- breadcrumb -->
@endsection



@section('content')


<!-- row -->
<div class="row">
    @if (session()->has('flasher'))
        <script>
            < div > {{ session('flasher') }}</div>
        </script>
    @endif



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
                                        <form id="formEdit{{ $Grade->id }}"
                                            action="{{ route('Grades.update', 'test') }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            {{ method_field('PATCH') }}
                                            <input type="hidden" name="id" value="{{ $Grade->id }}">
                                            <input type="hidden" name="Name"
                                                value="{{ $Grade->getTranslation('Name', 'ar') }}">
                                            <input type="hidden" name="Name_en"
                                                value="{{ $Grade->getTranslation('Name', 'en') }}">
                                            <input type="hidden" name="Notes" value="{{ $Grade->Notes }}">
                                            <button type="button" class="btn btn-info btn-sm"
                                                onclick="editGrade(event, {{ $Grade->id }})">
                                                <i class="fa fa-edit"></i> {{ trans('Grades_trans.Edit') }}
                                            </button>
                                        </form>

                                        <!-- زر حذف الصف -->
                                        <form id="formExlu{{ $Grade->id }}"
                                            action="{{ route('Grades.destroy', 'test') }}" method="post"
                                            style="display: inline;">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $Grade->id }}">
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmation(event, {{ $Grade->id }})">
                                                <i class="fa fa-trash"></i> {{ trans('Grades_trans.Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- delete_modal_Grade -->
                                {{-- <div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
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
                                </div> --}}
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- add_modal_Grade -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    </div> --}}

</div>

<!-- row closed -->
@endsection
@section('js')

<script>

</script>

@endsection
