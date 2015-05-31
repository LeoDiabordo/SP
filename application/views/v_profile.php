<div id="content-box" class="content-box clearfix">
    <h2>Profile Information</h2>
    <div class="inner-content">
        <div class="row">
            <div class="medium-3 columns panel">
            <label> Profile Image</label>
                <img aria-hidden=true src="<?php echo $user[0]['imagepath'];?>"/>
                <?php echo form_open_multipart('c_user/upload_image');?>
                <input type="file" name="userfile"/>
                <input type="submit" name="submit" value="Upload Image">
                </form>
            </div>
            <div class="medium-5 columns panel">
            <label> Basic Information</label>
                <table>
                    <tbody>
                        <tr>
                            <td> Student Number </td>
                            <td> <?php echo $profile['details'][0]->student_no;?> </td>
                        </tr>
                        <tr>
                            <td> Name </td>
                            <td> <?php echo $profile['details'][0]->lastname.", ".$profile['details'][0]->firstname." ".$profile['details'][0]->midname;?> </td>
                        </tr>
                        <tr>
                            <td> Birthdate</td>
                            <td> <?php  echo date("F d, Y", strtotime($profile['details'][0]->bdate)) ;?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="medium-4 columns panel">
            <label> Work Information</label>
                <table>
                    <tbody>
                        <tr>
                            <td> Student Number </td>
                            <td> <?php echo $profile['details'][0]->student_no;?> </td>
                        </tr>
                        <tr>
                            <td> Name </td>
                            <td> <?php echo $profile['details'][0]->lastname.", ".$profile['details'][0]->firstname." ".$profile['details'][0]->midname;?> </td>
                        </tr>
                        <tr>
                            <td> Birthdate</td>
                            <td> <?php  echo date("F d, Y", strtotime($profile['details'][0]->bdate)) ;?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            

        </div>

        <div class="row panel">
            <?php var_dump($profile);
            ?>     
        </div>
    </div>
</div>