
        <div class="left_side_bar"> 
          <? php echo anchor('doc/view_patient_info','See Patient Info');?>
          <div class="col_1">
            <h1>Patient Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('doc/index','Home');?></li></br>
                <li><?php echo anchor('doc/view_patient_history','See Patient History');?></li></br>
                <li><?php echo anchor('doc/give_prescription','Give Prescription');?></li></br>
              </ul>
            </div>
          </div>
          
          <div class="col_1">
            <h1>Doctor Menu</h1>
            <div class="box">
              <ul>

                <li><?php echo anchor('doc/edit_info','Edit Info');?></li></br>
                <li><?php echo anchor('doc/view_schedule','View Schedule');?></li></br>
                <li><?php echo anchor('doc/change_password','Change Password');?></li></br>
                <li><?php echo anchor('doc/log_out','Log Out');?></li></br>
              </ul>
            </div>
          </div>

        </div>

        <div class="right_section">
          <div class="common_content">
           <?php
                echo form_open('doc/view_schedule');
                echo form_label("Past / Present :",'');
                echo form_dropdown('viewSchedule',$scheduleList,$scheduleList[0]);
                echo form_submit('Submit','View');

                if($this->input->post('viewSchedule')!=null)
                {
                    echo $this->table->generate($query);
                }
            ?>
          </div>
          
        </div>

        <div class="clear"></div>
       
        