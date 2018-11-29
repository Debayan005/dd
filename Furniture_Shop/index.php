<?php 
    require_once 'core/init.php';
    include 'includes/head.php';

    $sql="SELECT * FROM products WHERE feature=1";
    $show_product=$db->query($sql);
?>
    <section class="nav_head">
        <nav class="navbar navbar-expand-lg navbar-light red" style="background-color:white;padding-left:20%;padding-right:20%;"
            id="head_bar">
            <!--<img src="pepsi.png"style="width:100;height:20" >-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav mx-auto">
                    <form class="form-inline" id="search_bar">
                        <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                        <button type="submit"><i class="material-icons">search</i></button>
                    </form>
                </ul>
                <ul class="navbar-nav  navbar-right">
                    <li class="nav-item">
                        <a href="#" class="nav-link"> Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"> Login</a>
                    </li>
                    <i class="nav-link large material-icons">insert_chart</i>
                </ul>
            </div>
        </nav>
    </section>
    <div id="break" style="height: 2px; background-color: #050505; width:100% "></div>
    <?php include 'includes/navigation.php';?>
    <div id="break" style="height: 2px; background-color: #050505; width:100% "></div>
    <section>
        <div id="image_wrap">
            <img src="Furniture.jpg">
        </div>
    </section>
    <section>
        <div class="text_center">
            <h2>Explore Our Range</h2>
            <hr>
        </div>
        <div class="sortcut" style="padding-left:20%;padding-right: 20%;margin-bottom:10px; ">
            <div class="row container justify-content-between">
                <a href="#">
                    <i class="material-icons">call</i>
                </a>
                <a href="#"><i class="material-icons">accessibility</i>
                    <h4>Access</h4>
                </a>
                <a href="#"><i class="material-icons">account_box</i>
                    <h4>Account Box</h4>
                </a>
                <a href="#"><i class="material-icons">add_alert</i>
                    <h4>Alerts</h4>
                </a>
                <a href="#"><i class="material-icons">assignment</i>
                    <h4>Assignments</h4>
                </a>
                <a href="#"><i class="material-icons">account_box</i>
                    <h4>Accounts</h4>
                </a>
            </div>
            <div class="row container justify-content-between">
                <a href="#">
                    <i class="material-icons">call</i>
                </a>
                <a href="#"><i class="material-icons">accessibility</i>
                    <h4>Access</h4>
                </a>
                <a href="#"><i class="material-icons">account_box</i>
                    <h4>Account Box</h4>
                </a>
                <a href="#"><i class="material-icons">add_alert</i>
                    <h4>Alerts</h4>
                </a>
                <a href="#"><i class="material-icons">assignment</i>
                    <h4>Assignments</h4>
                </a>
                <a href="#"><i class="material-icons">account_box</i>
                    <h4>Accounts</h4>
                </a>

            </div>
    </section>
    <section>
        <div class="text_center">
            <h2>What's New</h2>
            <hr>
        </div>
    </section>

    <div class="container">
        <div class="row">
           <?php while($product=mysqli_fetch_assoc($show_product)):?>
                <div class="col-sm-3">
                    <h4><?=$product['title']?></h4>
                    <img src=<?=$product['image']?>>
                    <p class='list price text-danger'>price_list <s>$<?=$product['list_price']?></s></p>
                    <p>our_price <?=$product['price']?></p>
                    <button type="button" class="btn-success" onclick="detail(<?=$product['id'];?>)">DetailS</button>
                </div>
           <?php endwhile;?>
        </div>
    </div>
   

<script>
    /*$(document).ready(function(){*/
        function detail(id){
            var data ={"id":id};
            $.ajax({
                url:'/Furniture_Shop/includes/model.php',
                type:"POST",
                data:data,
                success:function(data){
                    $('body').append(data);
                    $('#detail-1').modal('show');
                    
                },
                dataType: 'html',
                error:function(){
                    alert("something went wrong!!! ");
                }
            });
        }

</script>
</body>

</html>