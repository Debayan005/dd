<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/Furniture_Shop/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
$sql="SELECT * FROM categories WHERE parent =0";
$result=$db->query($sql);
$errors=array();
$category='';
$post_parent='';

//Edit category

if(isset($_GET['edit']) && !empty(['edit'])){
    $edit_id=(int)$_GET['edit'];
    $edit_sql="SELECT * FROM categories WHERE id='$edit_id'";
    $edit_querry=$db->query($edit_sql);
    $edit_category=mysqli_fetch_assoc($edit_querry);

}

//delete category
if(isset($_GET['delete']) &&(!empty($_GET['delete']))){
    $delete_category=(int)$_GET['delete'];
    $select_parent="SELECT * FROM categories WHERE id='delete_category'";
    $select_parent_query=$db->query($select_parent);
    $select_parent_query=mysqli_fetch_assoc($select_parent_query);
    if($select_parent_query==0){
        $delete_child="DELETE FROM categories WHERE parent='$delete_category'";
        $db->query($delete_child);
    }
    $sql_delete="DELETE FROM categories WHERE id='$delete_category'";
    $db->query($sql_delete);
    header('Location:categories.php');
}
// form process
if(isset($_POST) &&(!empty($_POST))){
    $post_parent=sanitize($_POST['parent']);
    $category=sanitize($_POST['category']);
    $sqlform="SELECT * FROM categories WHERE category='$category' AND parent='$post_parent'";
    if(isset($_GET['edit'])){
        $id=$edit_category['id'];
        $sqlform="SELECT * FROM categories WHERE category=$category AND parent='$post_parent' AND id!='$id'";
    }
    $form_result=$db->query($sqlform);
    // check category feild is empty
    if($category==''){
        $errors[].="empty category feild not accepted";
    }
    // check category already exists
    $count=mysqli_num_rows($form_result);
    if($count>0){
        $errors[].=$category." alredy exits";
    }

    // print error
    if (!empty($errors)){
        echo display_errors($errors);
    }else{
        $sql_insert="INSERT INTO categories (category,parent) VALUES ('$category','$parenpost_parentt')";
        if(isset($_GET['edit'])){
            $sql_insert="UPDATE catogeries SET category='$category' WHERE id='$edit_id'";
        }
        $db->query($sql_insert);
        header('Location:categories.php');

    }

}
$str='';
$parent_value=0;
if(isset($_GET['edit'])){
    $edit_id_value=$_GET['edit'];
    // $category_value_sql="SELECT category FROM categories WHERE id='$edit_id_value'";
    // $category_value_query=$db->query($category_value_sql);
    // $category_value=mysqli_fetch_assoc($category_value_query);
    // $str=implode('',$category_value);
    $str=$edit_category['category'];
    $parent_value=$edit_category['parent'];
}else{
    if(isset($_POST)){
        $str=$category;
        $parent_value=$post_parent;
    }
}

?>

<h2 class="text-center">Categories</h2>

<div class="row">
    <!-- form table -->
    <div class="col-md-6">
        <form class="form" action="categories.php<?= isset($_GET['edit'])?'?edit='.$edit_id:'';?>" method="post">
            <div class="form-group">
                <legend><?=isset($_GET['edit'])?'Edit ':'Add '?>Category</legend>
                <label for="parent">parent</label>
                <select class="form-control" name="parent" id="parent">
                    <option value="0"<?=(($parent_value==0)?'selected="selected"':'')?>>parent</option>
                    <?php while($parent=mysqli_fetch_assoc($result)):?>
                        <option value="<?=$parent['id']?>"<?=(($parent_value==$parent['id'])?'selected="selected"':'')?>><?=$parent['category']?></option>
                    <?php endwhile;?>
                </select>
            </div>
            <div class="form-group">
                <label for="category">category</label>
                <input type="text" class="form-control" name="category" id="category" value="<?=$str;?>">
            </div>
            <div class="form-group">
                <input value="<?=isset($_GET['edit'])?'Edit ':'Add ';?>Category" type="submit" class="btn btn-success ">
            </div>
        </form>
    </div>
    <!-- category table -->
    <div class="col-md-6">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Category</th><th>Parent</th><th>Edit</th>
            </thead>
            <tbody>
                <?php 
                $sql="SELECT * FROM categories WHERE parent =0";
                $result=$db->query($sql);
                while($category=mysqli_fetch_assoc($result)):
                    $parent_id=$category['id'];
                    $sql2="SELECT * FROM categories WHERE parent=$parent_id";
                    $parent_result=$db->query($sql2);
                ?>
                    <tr class="bg-info">
                        <td><?=$category['category'];?></td>
                        <td><?=$category['category'];?></td>
                        <td>
                            <a href="categories.php?edit=<?=$category['id'];?>"><i class="material-icons">brush</i></a>
                            <a href="categories.php?delete=<?=$category['id'];?>"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                    <?php while($child=mysqli_fetch_assoc($parent_result)):
                    ?>
                        <tr class="table-info ">
                            <td><?=$child['category'];?></td>
                            <td><?=$category['category'];?></td>
                            <td>
                                <a href="categories.php?edit=<?=$child['id'];?>"><i class="material-icons">brush</i></a>
                                <a href="categories.php?delete=<?=$child['id'];?>"><i class="material-icons">delete</i></a>
                            </td>
                        </tr>
                    <? endwhile;?>
                <?php endwhile;?>
                
            </tbody>
        </table>
    </div>
</div>