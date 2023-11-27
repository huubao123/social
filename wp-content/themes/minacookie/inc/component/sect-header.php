    <header id="page-header">
        <nav class="navigation background-is-dark">
            <div class="container">
                <div class="wrapper">
                    <div class="left">
                        <a href="" class="brand"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" alt=""></a>
                    </div>
                    <!--end left-->
                    <div class="right">
                        <ul class="nav navigation-links animate">
                            <li><a href="#page-top" class="scroll">Home</a></li>
                            <li><a href="#about" class="scroll">Why Condio</a></li>
                            <li><a href="#gallery" class="scroll">Features</a></li>
                            <li><a href="#contact" class="scroll">Contact</a></li>
                        </ul>

                        <div class="nav-btn">
                            <figure></figure>
                            <figure></figure>
                            <figure></figure>
                        </div>
                    </div>
                    <!--end right-->
                </div>
            </div>
            <!--end container-->
        </nav>
        <!--end navigation-->
        <div class="hero-section background-is-dark">
            <div class="wrapper">
                <div class="hero-title">
                    <div class="container">
                        <h1 class="animate">Get Ready.<br>We're finishing!</h1>
                        <form class="animate" id="form-hero">
                            <label for="form-hero-email">Enter your email for the latest news</label>
                            <div class="row">
                                <div class="col-md-5 col-sm-5">
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="form-hero-email" name="email" placeholder="Your email" required="">
                                        <span class="input-group-btn">
                                            <button class="btn" type="submit"><i class="arrow_right"></i></button>
                                        </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end wrapper-->
            <div class="owl-carousel" data-owl-dots="0" data-owl-nav="1" data-owl-autoplay="1" data-owl-loop="1" data-owl-fadeout="1">
                <div class="hero-slide">
                    
                    <?php 
                    $b_title_2 = get_field('block_title_2');
                    $b_desc_2 = get_field('block_desc_2');
                    $rows = get_field('block_item_2');
                    foreach($rows as $row) { 
                        ?>
                        <div class="bg-transfer">
                            <?php 
                            if($row['link']) echo '<a target="_blank" href="'.$row['link'].'" class="" >';
                            else echo '';

                            ?>
                                <img src="<?php echo $row['image']['url']; ?>"  alt="" />
                            <?php 
                            if($row['link']) echo '</a>';
                            else echo '';
                            ?>  
                        </div>          
                    <?php 
                    } ?>
                </div>
               
            </div>

              

            <!--end owl-carousel-->
        </div>
        <!--end hero-section-->
    </header>