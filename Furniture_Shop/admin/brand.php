<?php
    require_once "../core/init.php";
    include "includes/head.php";
    include "includes/navigation.php";

    $sql="SELECT * FROM brands ORDER BY brand ";
    $result_show=$db->query($sql);
    $errors=array();
    $GLOBALS['edit_id']=$_GET['edit'];
    echo $edit_id;

    // edit brand
    if(isset($_GET['edit']) && !empty($_GET['edit'])){
        $GLOBALS['edit_id']=(int)$_GET['edit'];
        echo $GLOBALS['edit_id'];
        // $edit_id=sanitize($edit_id);
        $sql2="SELECT * FROM brands WHERE id='$edit_id'";
        $edit_result=$db->query($sql2);
        $ebrand=mysqli_fetch_assoc($edit_result);

    }

    

    // delete brand
    if(isset($_GET['delete']) && !empty($_GET['delete'])){
        $delete_id=(int)$_GET['delete'];
        $delete_id=sanitize($delete_id);
        $sql="DELETE FROM brands WHERE id='$delete_id'";
        $db->query($sql);
        header('Location:brand.php');
    }
    if(isset($_POST['add_submit'])){
        $brand= sanitize($_POST['brand']);
        if($_POST['brand']==''){
            $errors[].='Empty Brand Field not excepted';
        }
    
    // check brand already exits!!!
        $sql="SELECT * FROM brands WHERE brand='$brand'";
        if(isset($_GET['edit'])){
            echo "entered";
            die();
            // $edit_id2=$_GET['edit'];
            echo GLOBALS('edit_id');
            $sql="SELECT * FROM brands WHERE brand='$brand' AND id !='$edit_id'";
        }
        $result=$db->query($sql);
        $count=mysqli_num_rows($result);
        if($count>0){
            $errors[].=$brand.' already exits!!!';
        }
        // display errors
        if(!empty($errors)){
            echo display_errors($errors);
        }
        else{
            $sql="INSERT INTO brands (brand) VALUES ('$brand')";
            $edit_id=$GLOBALS['edit_id'];

            // $sql="UPDATE brands SET brand='$brand' WHERE id='$edit_id'";
            if(isset( $GLOBALS['edit_id'])){
                // echo $edit_id2;
                $edit_id=$GLOBALS['edit_id'];
                echo $edit_id;
                die();
                $sql="UPDATE brands SET brand='$brand' WHERE id='$edit_id'";
            }
            $db->query($sql);
            header("Location:brand.php");
        }
    }
?>
<h2>brand</h2>



<!-- Brand form -->


<div class="text-center">
    <form class="form-inline" action="brand.php<?=((isset($GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
        <div class="form-group text-center">
            <?php 
            $brand_value='';
            if(isset($_GET['edit'])){
                $brand_value=$ebrand['brand'];
            }else{
                if(isset($_POST['brand'])){
                    $brand_value=sanitize($_POST['brand']);
                }
            };?>
            <label for="brand"> <?=((isset($_GET['edit']))?'Edit ':'Add a ') ;?>Brand</label>
            <input type="text" name="brand" class="form-control" id="brand" value="<?=$brand_value;?>">
            <?php if(isset($_GET['edit'])):?>
                <a href="brand.php"><button class="btn btn-default">cancel</button></a>
            <?php endif ;?>
            <input  type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit ':'Add ');?>brand"class="btn btn-success">
        </div>
    </form>
</div>
<hr>
<table class="table table-striped table-bordered table-auto table-dark">
    <thead class="text-center">
        <th></th><th>Brand</th><th></th>
    </thead>
    <tbody class="text-center">
        <?php while($brand=mysqli_fetch_assoc($result_show)):?>
            <tr>
                <td><a href="brand.php?edit=<?=$brand['id'];?>" class="btn btn-xs"><i class="tiny material-icons">add</i></a></td>
                <td><?=$brand['brand']?></td>
                <td><a  href="brand.php?delete=<?=$brand['id']?>"><i class="large material-icons">delete</i></a></td>
            </tr>
        <?php endwhile;?>
    </tbody>
</table>