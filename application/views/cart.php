<?php $this->load->view('partials/cart_header.php');?>
    <div class="main-container">
        <h1 class="check-out">Check out</h1>
        <a href="<?php base_url();?>" class="back"><i class="fas fa-arrow-circle-left"></i></a>
        <table>
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php       $mycart = $this->cart->contents();
            $total = 0;  
            foreach ($mycart as $item){
                $total = $total + $item['qty'] * $item['price']; ?>
                <tr>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['qty'] * $item['price'] ?></td>
                    <td><a href="/carts/remove_cart_item/<?= key($mycart); ?>" class="del"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
<?php       }                                                       ?>
            </tbody>
        </table>
        <p class="total">Total: <?=$total?></p>
        <div class="bill-info">
            <h1>Billing Info</h1>
            <div class="label">
                <p>Name:</p>
                <p>Address:</p>
                <p>Card No:</p>
            </div>
            <form action="/carts/purchase_order" method="POST">
                <input type="hidden" name="total" value="<?=$total?>">
                <input type="text" name="name">
                <input type="text" name="address">
                <input type="text" name="card_no">
                <input type="submit" value="Order">
            </form>
            <img src="/assets/images/card.png" alt="">
        </div>
    </div>
<?php $this->load->view('partials/cart_footer.php');?>