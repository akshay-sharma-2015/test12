<div class="col_12">
					<div class="col_6 Fl">
						<?php echo $this->Form->text($model.".fname",array('class' => 'Input01','placeholder' => __('Name*',true))); ?>
						<?php echo $this->Form->hidden($model.".display",array('value' => '21323')); ?>
					</div> 
					<div class="col_6 Fr"> 
						<?php echo $this->Form->text($model.".sname",array('class' => 'Input01','placeholder' => __('Surname *',true))); ?>
					</div>
				</div>
				<div class="col_12">
					<div class="col_6 Fl">
						<?php echo $this->Form->select($model.".gender",Configure::read('gender'),array('empty' => __('Genre',true) ,'class' => 'Input01 gender')); ?>
					</div>
					<div class="col_6 Fr">
						 <div class="col_6 Fl">
							<?php echo $this->Form->year($model.".b_year1",1970,date('Y'),array('class' => 'Input01','empty' => __('Age from',true))); ?>
						</div>
						<div class="col_6 Fr">
							<?php echo $this->Form->year($model.".b_year2",1970,date('Y'),array('class' => 'Input01','empty' => __('Age to',true))); ?>
						</div>
					</div>
				</div>
				<div class="col_12">
					<div class="col_4 Offset2"><?php echo $this->Form->text($model.".zip_code",array('class' => 'Input01','placeholder' => __('Zip code',true))); ?></div>
					<div class="col_4 Offset2"><?php echo $this->Form->text($model.".city",array('class' => 'Input01','placeholder' => __('City',true))); ?></div>
					<div class="col_3">
						<?php echo $this->Form->select($model.".province",Configure::read('province'),array('class' => 'Input01','empty' => __('Province',true))); ?>
					</div>
				</div>
				<div class="col_12">
					<div class="col_6 Fl">
						 <?php echo $this->Form->select($model.".opleidingsniveau",Configure::read('opleidingsniveau'),array('class' => 'Input01','empty' => __('Opleidingsniveau',true))); ?>
					</div>
					<div class="col_6 Fr Offset3">
						<?php echo $this->Form->input($model.".classification",array('options' =>Configure::read('classification') , 'type' => 'select','multiple' => 'checkbox','label' => false,'class' => 'checkbox-inline','div' => false,'label' => false)) ?>  
					</div>	
				</div>
				<div class="col_12 Offset3">
					<div class="col_4 Fl">Driving licence&nbsp;
						<?php echo $this->Form->checkbox($model.".is_driving_licence",array('type' => 'select','multiple' => 'checkbox','label' => false,'class' => 'checkbox-inline','div' => false,'label' => false)) ?>  yes            </div>
					<div class="col_4 Fl">Car&nbsp;
						<?php echo $this->Form->checkbox($model.".is_car",array('type' => 'select','multiple' => 'checkbox','label' => false,'class' => 'checkbox-inline','div' => false,'label' => false)) ?>  yes            </div>
					<div class="col_4 Fl">Var statement&nbsp;
						<?php echo $this->Form->checkbox($model.".var_statement",array('type' => 'select','multiple' => 'checkbox','label' => false,'class' => 'checkbox-inline','div' => false,'label' => false)) ?>  yes            </div>
				</div>
				<div style="border-top: 1px solid #ddd;" class="col_12 Offset3">
					<h1 class="Light18 Offset3">Info</h1>
				</div>
			  <div class="col_12">
				 <div class="col_6 Offset2">
					<label>Eyes</label>
					<?php echo $this->Form->select($model.".eyes",Configure::read('eyes'),array('class' => 'Input01','empty' => '- Eyes- ')) ?>  
				 </div>
				 <div class="col_6">
					<label>Hair color</label>
					<?php echo $this->Form->select($model.".hair_color",Configure::read('hair_color'),array('class' => 'Input01','empty' => '- hair color -')) ?>  
				  </div>
			  </div>
			  <div class="col_12">
				 <div class="col_6 Offset2">
					<label>Height</label>
					<?php echo $this->Form->select($model.".height",Configure::read('height'),array('class' => 'Input01','empty' => '- height -')) ?>  
				   
				 </div>
				 <div class="col_6 female">
					<label>Size blouse</label>
					<?php echo $this->Form->select($model.".blouse_size",Configure::read('blouse_size'),array('class' => 'Input01','empty' => '- blouse size -')) ?>  
				 </div>
			  </div>
			  <div class="col_12">
				 <div class="col_6 Offset2">
					<label>Custom t-shirt</label>
					<?php echo $this->Form->select($model.".t_shirt_size",Configure::read('t_shirt_size'),array('class' => 'Input01 ','empty' => '- t-shirt size -')) ?> 
					
				 </div>
				 <div class="col_6 female">
					<label>Cup size</label>
					<?php echo $this->Form->select($model.".cup_size",Configure::read('cup_size'),array('class' => 'Input01','empty' => '- cup size -')) ?> 
					
				 </div>
			  </div>
			  <div class="col_12">
				 <div class="col_6 Offset2">
					<label>Custom jeans</label>
					<?php echo $this->Form->select($model.".jeans_size",Configure::read('jeans_size'),array('class' => 'Input01','empty' => '- Jeans size -')) ?> 
				   
				 </div>
				 <div class="col_6 ">
					<label>Shoes size</label>
					<?php echo $this->Form->select($model.".shoes_size",Configure::read('shoes_size'),array('class' => 'Input01','empty' => '- Shoes size -')) ?> 
				   
				 </div>
			  </div>