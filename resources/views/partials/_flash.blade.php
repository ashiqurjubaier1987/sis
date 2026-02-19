<script>
    window.addEventListener('load', function () {
        let queue = [];
        let delay = 0;

        // Map session keys to notify types
        const typeMap = {
            success: 'success',
            error: 'danger',
            warning: 'warning',
            info: 'info'
        };

        // Flash messages
        @foreach (['success', 'error', 'warning', 'info'] as $key)
            @if (session()->has($key))
                queue.push({
                    message: @json(session($key)),
                    type: typeMap['{{ $key }}']
                });
            @endif
        @endforeach

        // Validation errors (always danger)
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                queue.push({
                    message: @json($error),
                    type: 'danger'
                });
            @endforeach
        @endif

        // Show notifications sequentially
        queue.forEach((item) => {
            setTimeout(() => {
                notify(
                    item.message,
                    "top",
                    "right",
                    "",
                    item.type,
                    "animated fadeInRight",
                    "animated fadeOutRight"
                );
            }, delay);

            delay += 500;
        });
    });
</script>
