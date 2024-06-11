<body>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <form id="formCreate" method="post">
                        <h1>Registrese aqui</h1>
                        <h3>Nombre</h3>
                        <input type="text" id="nombre" name="Nombre" placeholder="ingrese su nombre">
                        <h3>Apellido</h3>
                        <input type="text" id="apellido" name="Apellido" placeholder="ingrese su apellido">
                        <h3>Email</h3>
                        <input type="email" id="email" name="Email" placeholder="ingrese su email"><br>
                        <div class="g-recaptcha" data-sitekey="6LeRJvIpAAAAAG0WvfxA8kBgWwCeqMTXUHWuv7q0"></div>
                        <input type="submit" name="boton"> 
                    </form>
                </div>
                <div class="col-6">
                    <div class="mostrar">
                        <?php
                            $this->ShowUsers();
                        ?>
                    </div>
                </div>
            </div>
        </div>
</body>

<script>
    document.getElementById('formCreate').addEventListener('submit',function(event){
        var name = document.getElementById('nombre').value;
        var lastname = document.getElementById('apellido').value;
        var email =document.getElementById('email').value
        console.log('hola');
        if(name.trim() === '' || lastname.trim() === '' || email.trim() === ''){
           alert(<h3 class="bad">campos incompletos</h3>);
           event.preventDefault();
           return false;
        }

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert('Formato de correo electrónico no válido.');
                event.preventDefault();
                return false;
        }
    });
</script>