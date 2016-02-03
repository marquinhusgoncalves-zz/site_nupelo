<?php
$subjectPrefix = 'Site Stephannie Print';
$emailTo = '<marcus@mundosa.com.br>';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = stripslashes(trim($_POST['form-name']));
    $email   = stripslashes(trim($_POST['form-email']));
    $phone   = stripslashes(trim($_POST['form-tel']));
    $subject = stripslashes(trim($_POST['form-assunto']));
    $message = stripslashes(trim($_POST['form-mensagem']));
    $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';
    if (preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $subject)) {
        die("Header injection detected");
    }
    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);
    if($name && $email && $emailIsValid && $subject && $message){
        $subject = "$subjectPrefix $subject";
        $body = "Nome: $name <br /> Email: $email <br /> Telefone: $phone <br /> Mensagem: $message";
        $headers .= sprintf( 'Return-Path: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'From: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'Reply-To: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'Message-ID: <%s@%s>%s', md5( uniqid( rand( ), true ) ), $_SERVER[ 'HTTP_HOST' ], PHP_EOL );
        $headers .= sprintf( 'X-Priority: %d%s', 3, PHP_EOL );
        $headers .= sprintf( 'X-Mailer: PHP/%s%s', phpversion( ), PHP_EOL );
        $headers .= sprintf( 'Disposition-Notification-To: %s%s', $email, PHP_EOL );
        $headers .= sprintf( 'MIME-Version: 1.0%s', PHP_EOL );
        $headers .= sprintf( 'Content-Transfer-Encoding: 8bit%s', PHP_EOL );
        $headers .= sprintf( 'Content-Type: text/html; charset="utf-8"%s', PHP_EOL );
        mail($emailTo, "=?utf-8?B?".base64_encode($subject)."?=", $body, $headers);
        $emailSent = true;
    } else {
        $hasError = true;
    }
}
?>
<div class="container">
    <?php if(!empty($emailSent)): ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success text-center">Sua mensagem foi enviada com sucesso.</div>
        </div>
    <?php else: ?>
        <?php if(!empty($hasError)): ?>
            <div class="col-md-5 col-md-offset-4">
                <div class="alert alert-danger text-center">Houve um erro no envio, tente novamente mais tarde.</div>
            </div>
        <?php endif; ?>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="contact-form" class="form-horizontal" role="form" method="post">
           <div class="col-md-6">
            <input type="text" class="form-control" id="form-name" name="form-name">
            <label for="form-name">Nome</label>
            <input type="email" class="form-control" id="form-email" name="form-email">
            <label for="form-email">e-mail</label>
            <input type="tel" class="form-control" id="form-tel" name="form-tel">
            <label for="form-tel">Cel | Tel</label>
            <input type="text" class="form-control" id="form-assunto" name="form-assunto">
            <label for="form-assunto">Assunto</label>
        </div>
        <div class="col-md-6">
            <div>
              <textarea class="form-control" rows="7" id="form-mensagem" name="form-mensagem"></textarea>
              <label for="form-mensagem">Mensagem</label>
          </div>
          <div class="botao-form">
              <button type="submit" class="btn btn-default">Enviar <i class="fa fa-paper-plane-o"></i></button>
          </div>
      </div>
  </form>
</div>
<?php endif; ?>
</div><!-- contact no index -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>