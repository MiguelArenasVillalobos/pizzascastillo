<form method="post" class="reserva-contacto">
  <h2>Realiza una reservación</h2>
  <div class="campo">
    <input type="text" name="nombre" placeholder="Nombre" required="required">
  </div>

  <div class="campo">
    <input type="datetime-local" name="fecha" placeholder="Fecha" step="300" required="required">
  </div>

  <div class="campo">
    <input type="email" name="correo" placeholder="Correo" required="required">
  </div>

  <div class="campo">
    <input type="tel" name="telefono" placeholder="Télefono" required="required">
  </div>

  <div class="campo">
    <textarea name="mensaje" placeholder="Mensaje" required="required"></textarea>
  </div>

  <div class="g-recaptcha" data-sitekey="6Lf3sq0UAAAAAAb5q8X4K1bEKBYrBghkDBDfILDe"></div>

  <input type="submit" name="enviar" value="Enviar" class="button">
  <input type="hidden" name="oculto" value="1">
</form>