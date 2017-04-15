<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras - Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <div class="page-header">
        <h1>Carrinho</h1>
        <a href="index.php" class="btn btn-default">Home</a>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td><b>R$ <?php echo number_format($cartTotal, 2, ',', '.')?></b></td>
                <td></td>
            </tr>
        </tfoot>
        <tbody>
        <?php foreach ($cartItems as $item) : ?>
            <tr>
                <td><?php echo $item->getProduct()->getId()?></td>
                <td><?php echo $item->getProduct()->getName()?></td>
                <td>
                    <form action="index.php?page=cart&action=update" method="post">
                        <input name="id" type="hidden" value="<?php echo $item->getProduct()->getId()?>" />
                        <input size="2" type="text" name="quantity" value=" <?php echo $item->getQuantity()?>"/>
                        <button type="submit" class="btn btn-primary btn-xs">Alterar</button>
                    </form>
                </td>
                <td>R$ <?php echo number_format($item->getProduct()->getPrice(), 2, ',', '.')?></td>
                <td>R$ <?php echo number_format($item->getSubTotal(), 2, ',', '.')?></td>
                <td>
                     <a href="index.php?page=cart&action=delete&id=<?php echo $item->getProduct()->getId()?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

</body>
</html>