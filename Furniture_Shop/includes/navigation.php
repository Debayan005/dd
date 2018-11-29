<?php
    $sql="SELECT * FROM categories WHERE parent=0";
    $pquary=$db->query($sql);
?> 

<section>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:white;padding-left:20%;padding-right:20%;"
        id="nav_bar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container collapse navbar-collapse" id="navbarText">
            <div class="container">
                <ul class="navbar-nav justify-content-between">
                    <?php while($parent=mysqli_fetch_assoc($pquary)):?>
                    <?php 
                        $parent_id=$parent['id'];
                        $sql2="SELECT * FROM categories WHERE parent=$parent_id";
                        $cquery=$db->query($sql2);
                    ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <?php echo $parent['category'];?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php while($parent=mysqli_fetch_assoc($cquery)):?>
                              <a class="dropdown-item" href="#"><?php echo $parent['category'];?></a>
                            <?php endwhile;?>
                        </li>
                    <?php endwhile ;?>
                </ul>
            </div>
        </div>
    </nav>
</section>