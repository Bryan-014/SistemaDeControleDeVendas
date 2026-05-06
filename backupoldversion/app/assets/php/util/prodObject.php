<script>
  var produtos = [
    <?php
      foreach ($products as $product) {
        echo("{cod: '".$product["cod"]."', desc: '".$product["descricao"]."', preco: '".$product["preco"]."', cat: '".$product['categoria']."'},");
      }
    ?>
  ];  
  var adicionais = [
    <?php
      foreach ($adds as $add) {
        echo("{code: '".$add["cod"]."', desc: '".$add["descricao"]."', preco: '".$add["preco"]."', cat: '".$add['categoria']."'},");
      }      
    ?>
  ];
</script>
