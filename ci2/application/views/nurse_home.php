
        <div class="left_side_bar"> 
          <? php echo anchor('doc/view_patient_info','See Patient Info');?>
          <div class="col_1">
            <h1>Genaral Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('nurse/index','Home');?></li></br>
                <li><?php echo anchor('nurse/edit_info','Edit Info');?></li></br>
                <li><?php echo anchor('nurse/view_schedule','View Schedule');?></li></br>
                <li><?php echo anchor('nurse/change_password','Change Password');?></li></br>
                <li><?php echo anchor('nurse/log_out','Log Out');?></li></br>
              </ul>
            </div>
          </div>
          
          
        </div>

        <div class="right_section">
          <div class="common_content">
            <h2>Information</h2>
            <h3><?php echo "Welcome $username" ?></h3>
            <hr>
            <p><?php echo $this->table->generate($query['info']);?></p>
            
          </div>
          
        </div>

        <div class="clear"></div>
       
        