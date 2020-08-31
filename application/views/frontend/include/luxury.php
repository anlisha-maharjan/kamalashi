<section id="section-gallery-view">
    <div class="container text-center ">
        <h2 class="text-gold">Re-imagined Luxury</h2>
        <p class="text-light-gold centered-text"></p>
        <div class="row">
            <?php
            $count = 1;
            if (isset($gallery) && !empty($gallery)) {
                foreach ($gallery as $data) {
                    if ($count <= 3) {
                        ?>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <a href="<?php echo base_url().'gallery/'.$data->slug; ?>" class="product-wrap text-center text-gold">
                                <figure>
                                    <?php
                                    $arr = explode('/', $data->cover);

                                    if (end($arr)) {
                                        $alt_tag = str_replace('-', '', end($arr));
                                    }
                                    ?> 
                                    <img src="<?php echo $data->cover; ?>" alt="<?php echo $alt_tag; ?>"/>

                                </figure>
                                <h4 class="text-gold"><?php echo $data->name; ?></h4>
                                <?php if (isset($data->short_description) && $data->short_description) { ?>
                                    <p class="text-light-gold"><?php
                                        echo strip_tags(substr($data->short_description, 0, 200));
                                        echo (strlen($data->short_description) > 200) ? '...' : '';
                                        ?>
                                    </p> 
                                <?php } ?>

                            </a>
                        </div>

                        <?php
                        $count ++;
                    }
                }
            }
            ?>
        </div>                    
        <a href="<?php echo base_url().'gallery/'; ?>" class="btn-light-golden width-auto">View Our Gallery</a>
    </div>
</section>