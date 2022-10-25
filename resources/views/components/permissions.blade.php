<script>
    @auth
        window._permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
    @else
        window._permissions = [];
    @endauth
</script>