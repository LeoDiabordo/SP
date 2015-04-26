<div id="content-box" class="content-box clearfix">
    <div class="inner-content">
        <div class="row panel">
            <h1>UPLB Graduates</h1>
        </div>
    
        <div class="row panel">
            <?php foreach($yearlist as $row) { ?>
            <div class="yearbook-year medium-2 columns">
                <a class="th" role="button" aria-label="Thumbnail" href="../assets/img/examples/space.jpg">
                <img aria-hidden=true src="<?php echo base_url();?>/assets/img/uplb-logo.png"/>
                </a>
                <?php echo $row['year'];?>
            </div>
            <?php }?>
        </div>
    </div>
</div>