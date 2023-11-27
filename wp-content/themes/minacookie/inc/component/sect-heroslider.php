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