<div class="mb-3">
    <label>@lang('Verification Code')</label>
    @if($errors->has('code'))
                            <small class="text-danger d-block">{{ $errors->first('code') }}</small>
                        @endif
    <div class="verification-code">
        <input type="text" name="code" id="verification-code" class="form-control overflow-hidden" required autocomplete="off" style="width: 100%; margin-bottom: 16px; margin-top: 0">
        <div class="boxes">
            <span>-</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
            <span>-</span>
        </div>
    </div>
</div>

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/global/css/verification-code.css') }}">
@endpush

@push('script')
    <script>
        $('#verification-code').on('input', function () {
            $(this).val(function(i, val){
                if (val.length >= 6) {
                    $('.submit-form').find('button[type=submit]').html('<i class="fa fa-spinner fa-spin"></i>');
                    $('.submit-form').submit()
                }
                if(val.length > 6){
                    return val.substring(0, val.length - 1);
                }
                return val;
            });
            for (let index = $(this).val().length; index >= 0 ; index--) {
                $($('.boxes span')[index]).html('');
            }
        });
    </script>
@endpush
