@isset($data)
    @php
        $response = [
            Information::PENDING => [
                'status' => 'PENDING',
                'css' => 'bg-gradient-secondary',
            ],
            Information::PUBLISHED => [
                'status' => 'PUBLISHED',
                'css' => 'bg-gradient-info',
            ],
            Information::FUTURE => [
                'status' => 'FUTURE',
                'css' => 'bg-gradient-success',
            ],
        ];
    @endphp
    <button style="width: 130px" type="button" class="btn {{ $response[$data]['css'] }}">
        {{ $response[$data]['status'] }}
    </button>
@endisset
