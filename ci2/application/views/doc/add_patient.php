
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
            <h2>Information</h2>
            <hr>
            <p><strong>Something</strong></p>
            <p>Something else</p>
            <a href="#">Read more</a> 
            <hr>
            <p>More things</p><br>
          </div>
          
        </div>

        <div class="clear"></div>
       
        