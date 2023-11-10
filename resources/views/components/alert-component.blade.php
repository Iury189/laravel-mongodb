@if (session('success_store'))
    <script>
        Swal.fire({
            title: 'Registro criado',
            text: '{{ session('success_store') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('success_update'))
    <script>
        Swal.fire({
            title: 'Registro atualizado',
            text: '{{ session('success_update') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('success_trash'))
    <script>
        Swal.fire({
            title: 'Registro enviado a lixeira',
            text: '{{ session('success_trash') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('success_restored'))
    <script>
        Swal.fire({
            title: 'Registro restaurado',
            text: '{{ session('success_restored') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@elseif (session('success_destroy'))
    <script>
        Swal.fire({
            title: 'Registro excluído',
            text: '{{ session('success_destroy') }}',
            icon: 'success',
            timer: 5000,
            showConfirmButton: false,
            allowOutsideClick: true
        });
    </script>
@endif
