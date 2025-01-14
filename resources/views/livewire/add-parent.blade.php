<div>
    <!-- رسائل النجاح والخطأ -->
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif

    @if ($show_table)
        @include('livewire.Parent_Table')
    @else
        <div class="stepwizard">
            @foreach ([1, 2, 3] as $step)
                <div class="stepwizard-step">
                    <a href="#step-{{ $step }}" 
                       type="button"
                       class="btn btn-circle {{ $currentStep != $step ? 'btn-default' : 'btn-success' }}">{{ $step }}</a>
                    <p>{{ trans('Parent_trans.Step' . $step) }}</p>
                </div>
            @endforeach
        </div>

        <div>
            @include('livewire.Father_Form')
            @include('livewire.Mother_Form')

            <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
                <div class="col-xs-12">
                    <div class="col-md-12"><br>
                        <label style="color: red">{{ trans('Parent_trans.Attachments') }}</label>
                        <div class="form-group">
                            <!-- إخفاء input للملفات -->
                            <input type="file" wire:model="photos" accept="image/*" multiple id="fileInput" style="display: none;">
                            
                            <!-- زر مخصص -->
                            <button type="button" class="btn btn-secondary btn-sm" onclick="document.getElementById('fileInput').click()">
                                {{ trans('Parent_trans.SelectFiles') }}
                            </button>
                            
                            <!-- عرض عدد الملفات -->
                            <div class="mt-2">
                                <small class="text-muted">
                                    {{ count($photos ?? []) }} {{ trans('Parent_trans.FilesSelected') }}
                                </small>
                            </div>
                            
                            <!-- عرض حالة التحميل -->
                            <div wire:loading wire:target="photos" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <br>

                        <input type="hidden" wire:model.live="Parent_id">

                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>

                        @if ($updateMode)
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_edit"
                                    type="button">{{ trans('Parent_trans.Finish') }}
                            </button>
                        @else
                            <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                    type="button">{{ trans('Parent_trans.Finish') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
