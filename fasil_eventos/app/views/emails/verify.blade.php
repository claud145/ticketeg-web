<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Este mail es para verificar tu correo electronico</h2>

        <div>
            Gracias por registrar una cuenta en Ticketeg
            Por favor sigue el link para verificar tu correo electronico.
            {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>
        </div>
          
       
    </body>
</html>