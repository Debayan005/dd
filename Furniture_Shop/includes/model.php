<?php
require_once '../core/init.php';
$id=$_POST['id'];
$id=(int)$id;
$sql="SELECT * FROM products WHERE id='$id'";
$result=$db->query($sql);
$product=mysqli_fetch_assoc($result);
$brand_id=$product['brand'];
$sql1="SELECT brand FROM brands WHERE id='$brand_id'";
$brand_query= $db->query($sql1);
$brand=mysqli_fetch_assoc($brand_query);
$string=$product['size'];
$string_array=explode(',',$string);
?>



<?php ob_start();?>
  
<div class="modal fade" id="detail-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title"><?=$product['title'];?></h2>
                <button type="button" class="close" onclick="closeModal()"><span>&times;</span></button>
            </div>
            <div class="modal-body" id="clothes">
                <div class="contanier-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="center-block"><img src="<?=$product['image'];?>"></div>
                        </div>
                        <div class="col-sm-6">
                            <h4><?=$product['description'];?></h4>
                            <p>Price: <?=$product['price'];?></p>
                            <p>brand: <?=$brand['brand'];?></p>
                            <form action="add_cart.php" method="post">
                            <div class="form-group">
                            <label for="size">size:</label>
                            <select name="size" id="size" class="form-control">
                            <option value=""></option>
                            <?php foreach($string_array as $size_array) {
                                $array=explode(':',$size_array);
                                $size=$array[0];
                                $quantity=$array[1];
                                echo '<option value='.$size.'>'.$size.'('.$quantity.' Available)</option>';
                            };?>
                            </select>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeModal()">close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function closeModal(){
        $('#detail-1').modal('hide');
        setTimeout(function(){
            $('#detail-1').remove();
        },500);
    }
</script>
<?= ob_get_clean();?>