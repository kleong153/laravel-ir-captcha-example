<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IR Captcha Demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body onload="initPage();">
    <div class="mx-auto mt-4 w-100 px-1" style="max-width: 340px;">
        <div class="d-flex justify-content-center mb-2">
            <h5>Demo Login With IR Captcha</h5>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-center mb-3">
                    <a href="javascript:void(0);" onclick="setTheme('light');">Light Theme</a>
                    &nbsp;|&nbsp;
                    <a href="javascript:void(0);" onclick="setTheme('dark');">Dark Theme</a>
                </div>

                <form id="login_form" action="{{ url('/do-login') }}" method="POST" onsubmit="return onSubmit(event);">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="captcha_token" value="">

                    <div class="d-flex flex-column">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="name@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="Password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-2">
            <a href="https://github.com/kleong153/laravel-ir-captcha-example" target="_blank">GitHub</a>
        </div>
    </div>

    <div id="ir_captcha_modal" class="modal" tabindex="-1">
        <div class="modal-dialog" style="width: 314px;">
            <div class="modal-content">
                <div class="modal-body align-middle">
                    <div class="d-flex flex-row-reverse mb-1">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <iframe id="ir_captcha_iframe" src="" title="IR Captcha Verification" height="276" width="280"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>

    <script>
        const loginForm = document.getElementById("login_form");
        const captchaTokenInput = document.querySelector("input[name='captcha_token']");
        const model = document.getElementById("ir_captcha_modal");
        const iframe = document.getElementById("ir_captcha_iframe");

        const captchaStatusListener = (event) => {
            if (event.origin !== window.location.origin) {
                // Only accept messages from same domain.
                return;
            } else if (event.data && event.data.type === "irCaptcha" && event.data.status === "success") {
                // Fill in captcha token and continue form submission.
                captchaTokenInput.value = event.data.captchaToken;

                loginForm.submit();
            }
        };

        function initPage() {
            model.addEventListener('shown.bs.modal', () => {
                // Load iframe after modal is opened and fade-in animation is finished.
                const theme = document.documentElement.getAttribute("data-bs-theme");
                const modelContent = document.querySelector("#ir_captcha_modal .modal-content");

                let captchaUrl = "{{ ir_captcha()->iframeUrl(false) }}";

                if (theme === "dark") {
                    // Set modal's background color to match with captcha's background color.
                    modelContent.style.backgroundColor = "#1b1b1b";
                    captchaUrl += "?theme=dark";
                } else {
                    modelContent.style.backgroundColor = "";
                }

                iframe.src = captchaUrl

                window.addEventListener("message", captchaStatusListener);
            });

            model.addEventListener('hidden.bs.modal', () => {
                // Modal closed. Reset state and remove event listener.
                iframe.src = "";
                captchaTokenInput.value = "";

                window.removeEventListener("message", captchaStatusListener);
            });
        }

        function setTheme(theme) {
            document.documentElement.setAttribute("data-bs-theme", theme);
        }

        function onSubmit(event) {
            if (captchaTokenInput.value) {
                // Has captcha token, continue form submission.
                return true;
            }

            // No captcha token, stop form submission and show captcha modal.
            event.preventDefault();

            const bsModal = new bootstrap.Modal(model, {
                backdrop: "static"
            });

            bsModal.show();

            return false;
        }
    </script>
</body>

</html>
