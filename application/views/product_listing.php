<?php $this->load->view('partials/list_header.php');?>
    <div class="main-container">
        <h1>Products</h1>
        <p><a href="/carts/cart">Your Cart(<?=count($this->cart->contents())?>)</a></p>
        <table>
            <thead>
                <tr>
                    <th>Desription</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php       for($i=0;$i<count($products);$i++){     ?>
                <tr>
                <form action="/carts/add_to_cart" method="post">

                    <input type="hidden" name="product_id" value="<?=$products[$i]['id']?>">

                    <td><?=$products[$i]['product']?></td>
                    <input type="hidden" name="product" value="<?=$products[$i]['product']?>">

                    <td><?=$products[$i]['price']?></td>
                    <input type="hidden" name="price" value="<?=$products[$i]['price']?>">

                    <td><input type="number" name="quantity" id="" min="1" max="<?=$products[$i]['quantity']?>"></td>
                    
                    <td><input type="submit" value="Buy" class="buy"></td>
                </form>
                </tr>
<?php       }                                       ?>                
            </tbody>
            
        </table>
<?php
        //var_dump($this->cart->contents());
?>
        
        <img src="<?=base_url();?>/assets/images/undraw_empty_cart_co35" alt="">
        <?= $this->session->flashdata('success_purchase');?>
    </div>

<?php $this->load->view('partials/list_footer.php');?>