<!-- password-generator.blade.php -->
<div class="container" style="padding: 30px;">
    <h5 style="color: white;">Generar una contraseña segura</h5>
    <div class="row align-items-center">
        <div class="col">
            <div class="input-group">
                <input type="text" class="form-control" id="generatedPassword" placeholder="Generar contraseña segura">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="copyButton">
                        <i class="mdi mdi-content-paste"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary" id="generateButton">Generar</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('generateButton').addEventListener('click', function () {
        var password = generatePassword(20);
        document.getElementById('generatedPassword').value = password;
    });

    document.getElementById('copyButton').addEventListener('click', function () {
        var passwordInput = document.getElementById('generatedPassword');
        passwordInput.select();
        document.execCommand('copy');
    });
});

function generatePassword(length) {
    var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*@#";
    var retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}
</script>
    
