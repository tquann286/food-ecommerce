<footer class="footer bg-dark text-light">
    <div class="container">
        <p class="text-center mb-0">Trang web được phát triển bởi Nhóm BatOn</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

<script>
    (function () {
        'use strict';

        var forms = document.querySelectorAll('.needs-validation');

        Array.from(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

</html>
<?php ob_end_flush(); ?>