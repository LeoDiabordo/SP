<div id="content-box" class="content-box clearfix">
    <div class="inner-content">
        <div class="row panel">
            <form method='post' action='<?php echo base_url('index.php/c_user/create_post');?>'>
                <div class="large-10 columns">
                    <textarea rows="2" name="post_body" id="post_field" placeholder="Todeh is awesum" ></textarea>
                </div>
                <div class="large-2 columns">
                    <input type="submit" name="post_submit" value="Submit" id="post_submit" class="button radius" />
                </div>
            </form>
        </div>

        <div class="row panel">
            <?php foreach($posts as $row){ 
                echo "<h4>".$row['firstname']." ".$row['lastname']."</h4>";
                echo $row['body']."<div class='large-12 columns'><div class='large-8 large-offset-2 columns'><hr></div></div>";}
            ?>     
        </div>
    </div>
</div>