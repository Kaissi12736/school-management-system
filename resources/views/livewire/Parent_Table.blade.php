<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('Parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.Email') }}</th>
            <th>{{ trans('Parent_trans.Name_Father') }}</th>
            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
            <th>{{ trans('Parent_trans.Job_Father') }}</th>
            <th>{{ trans('Parent_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($my_parents as $my_parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->Email }}</td>
                <td>{{ $my_parent->Name_Father }}</td>
                <td>{{ $my_parent->National_ID_Father }}</td>
                <td>{{ $my_parent->Passport_ID_Father }}</td>
                <td>{{ $my_parent->Phone_Father }}</td>
                <td>{{ $my_parent->Job_Father }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>

                            
                         <button onclick="confirmDelete({{ $my_parent->id }})" class="btn btn-danger btn-sm"
                            title="{{ trans('Grades_trans.Delete') }}">
                            <i class="fa fa-trash"></i>
                        </button>
                        
                 </td>
            </tr>
        @endforeach
    </table>
</div>
<script>
    function confirmDelete(id) {
          Swal.fire({
              title: "{{ __('main_trans.confirm_delete_title') }}", // ترجمة العنوان
              text: "{{ __('main_trans.confirm_delete_text') }}",   // ترجمة النص
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "{{ __('main_trans.confirm_button') }}", // ترجمة زر التأكيد
              cancelButtonText: "{{ __('main_trans.cancel_button') }}"    // ترجمة زر الإلغاء
          }).then((result) => {
              if (result.isConfirmed) {
                  Livewire.dispatch('delete', { id: id }); // تمرير البيانات ككائن
              }
          });
      }
  </script>
  