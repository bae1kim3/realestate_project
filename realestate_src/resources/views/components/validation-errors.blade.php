@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('인증 오류! 입력한 내용을 확인해주세요') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-black dark:text-white">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
