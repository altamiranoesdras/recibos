<style>
  footer {
    color: #777777;
    width: 100%;
    border-top: 1px solid #AAAAAA;
    padding: 8px 0;
    text-align: center;
  }
</style>
<footer>
  factura generada por el usuario {{Auth::user()->username}} el {{fechaHoraActual()}}
</footer>