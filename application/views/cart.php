<?php $this->load->view('partials/cart_header.php');?>
    <div class="main-container">
        <h1 class="check-out">Check out</h1>
        <a href="/" class="back"><i class="fas fa-arrow-circle-left"></i></a>
        <table>
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Description</th>
                    <th>Total Price:</th>
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
        <p class="total">Total Amount: <?=$total?></p>
        <div class="bill-info">
            <h1>Billing Info</h1>
<?php           $attributes = array('role' => 'form');                  ?>
                <?=form_open('/carts/purchase_order',$attributes);?>               
            <!-- <form action="/carts/purchase_order" method="POST"> -->
                <input type="hidden" name="total" value="<?=$total?>">
                <input type="text" name="name" value="<?php echo set_value('name');?>" placeholder="Name">
                <?php echo form_error('name'); ?>
                <input type="text" name="address" value="<?php echo set_value('address');?>" placeholder="Address">
                <?php echo form_error('address'); ?>
                <input type="text" name="card_no" value="<?php echo set_value('card_no');?>" placeholder="Card No">
                <?php echo form_error('card_no'); ?>
                <input type="submit" value="Order">
            </form>
            <img src="/assets/images/card.png" alt="">
        </div>
    </div>
<?php $this->load->view('partials/cart_footer.php');?>