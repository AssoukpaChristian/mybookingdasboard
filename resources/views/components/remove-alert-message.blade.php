@script
    <script>
            window.addEventListener('message-session', function (event) {
                let alerts = document.querySelectorAll('.alert');
                if(alerts){
                    setTimeout(function () {

                    alerts.forEach(alert => {
                        alert.style.transition = "opacity 0.5s";
                        alert.style.opacity = "0";
                        setTimeout(() => alert.remove(), 500);
                    });
                    }, 3000);
                }
            });
    </script>
@endscript
