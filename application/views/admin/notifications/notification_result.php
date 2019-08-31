<link rel="stylesheet" href="<?= base_url() ?>public/responses/responses_v1.css">


<div data-v-d39bd79a="" class="col-sm-12 col-md-12 col-lg-12">

        <div data-v-d39bd79a="" class=" response-view">
        <div data-v-7fab6d66="" data-v-d39bd79a="">
            <div data-v-7fab6d66="" class="">
                <div data-v-7fab6d66="" class=""><!----></div> 
                <div data-v-7fab6d66="" class=""><!----> 
                    <div data-v-7fab6d66="" class="conversation"> 
                        <div id="loading" style="display: none;" class="">
                            Loading Please Wait....
                            <img src="<?= base_url(); ?>public/dist/img/gif/ajax-loader.gif" alt="Loading" style="margin-right: 500px;"/>
                        </div>
                        <div id="respons_view">

       <div data-v-7fab6d66="" class="card-heading border bottom"><strong data-v-7fab6d66="">View Response</strong></div>
       <hr>
       <div data-v-7fab6d66="" class="row">
	<div data-v-7fab6d66="" class="col-md-4">
		<table data-v-7fab6d66="" class="table table-bordered">
			<tbody data-v-7fab6d66="">
				<tr data-v-7fab6d66="">
					<th data-v-7fab6d66="">Device</th> 
					<td data-v-7fab6d66=""><?= $tableView->device; ?></td>
				</tr> 
<!--				<tr data-v-7fab6d66="" style="display: none;">
					<th data-v-7fab6d66="">Location</th> 
					<td data-v-7fab6d66=""></td>
				</tr> -->
				<tr data-v-7fab6d66="">
					<th data-v-7fab6d66="">Synced At</th> 
                                        <td data-v-7fab6d66=""><?= date('d-M-Y', strtotime($tableView->device_time)); ?>,<?= date('H:i a', strtotime($tableView->device_time)); ?></td>
				</tr> 
				<tr data-v-7fab6d66="">
					<th data-v-7fab6d66="">Device Time</th> 
						<td data-v-7fab6d66=""><?= date('d-M-Y', strtotime($tableView->device_time)); ?>,<?= date('H:i a', strtotime($tableView->device_time)); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
                            
                            <?php
if($question_view){
    $json1 = $question_view->options;
    $json_question =  json_decode($json1, true);
    }
?> 
    
                               <?php
                               if($question_view){
                               foreach ($json_question['question'] as $Qcount => $Qrow):
                                   $ch_type = $json_question['question'][$Qcount]['type'];
                               if($json_question['question'][$Qcount]['sequence_no'] == ($Qcount+1)){
                              ?>
                                 
                                    <div data-v-7fab6d66="" class="conversation-item">
                                        <div data-v-7fab6d66="" class="left"><?= $json_question['question'][$Qcount]['text']['en']; ?></div> <br data-v-7fab6d66=""> 
                                        
                                        <?php 
                                        if($tableView){
                                          $json2 = $tableView->responses;
                                          $responses_view = json_decode($json2, true);
                                          
                                          foreach ($responses_view['response'] as $res_count=>$res_data):
                                               if($responses_view['response'][$res_count]['type'] == 1 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                                    <div data-v-7fab6d66="" class="right">
                                                        <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                            <div data-v-6980cd13="" data-v-7f99aea2="" class="answer-star">
                                                                <i data-v-6980cd13="" class="fa fa-star"></i> <?= $responses_view['response'][$res_count]['value']; ?>/5
                                                            </div> <!---->
                                                        </div>
                                                    </div>
                                        <?php
                                               } else if($responses_view['response'][$res_count]['type'] == 2 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-0bed168c="" data-v-7f99aea2="" class="answer-multistar">
                                                    <?php
                                                        foreach ($responses_view['response'][$res_count]['value'] as $mstar=> $mstarData): ?>
                                                          <div data-v-0bed168c=""> <?= $responses_view['response'][$res_count]['value'][$mstar]['option']; ?>
                                                            <span data-v-0bed168c=""><i data-v-0bed168c="" class="fa fa-star"></i> 
                                                                <strong data-v-0bed168c=""><?= $responses_view['response'][$res_count]['value'][$mstar]['value']; ?>/5</strong>
                                                            </span>
                                                         </div>
                                                    <?php  endforeach; ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 3 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                                    <div data-v-7fab6d66="" class="right">
                                                        <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                            <div data-v-6980cd13="" data-v-7f99aea2="" class="answer-star">
                                                                <i data-v-6980cd13="" class="fa fa-smile-o"></i> <?= $responses_view['response'][$res_count]['value']; ?>/5
                                                            </div> <!---->
                                                        </div>
                                                    </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 4 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-0bed168c="" data-v-7f99aea2="" class="answer-multismiley">
                                                    <?php
                                                        foreach ($responses_view['response'][$res_count]['value'] as $mstar=> $mstarData): ?>
                                                          <div data-v-0bed168c=""> <?= $responses_view['response'][$res_count]['value'][$mstar]['option']; ?>
                                                            <span data-v-0bed168c=""><i data-v-0bed168c="" class="fa fa-smile-o"></i> 
                                                                <strong data-v-0bed168c=""><?= $responses_view['response'][$res_count]['value'][$mstar]['value']; ?>/5</strong>
                                                            </span>
                                                         </div>
                                                    <?php  endforeach; ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 5 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-0bed168c="" data-v-7f99aea2="" class="answer-multismiley">
                                                    <?php
                                                        foreach ($responses_view['response'][$res_count]['value'] as $mDatafCount=> $mDatafData): ?>
                                                         <div data-v-1532abc2="" data-v-7f99aea2="" class="answer-multifield">
                                                            <ul data-v-1532abc2="">
                                                                <li data-v-1532abc2=""><?= $responses_view['response'][$res_count]['value'][$mDatafCount]['name']; ?> : 
                                                                    <strong data-v-1532abc2=""><?= $responses_view['response'][$res_count]['value'][$mDatafCount]['value']; ?></strong></li>
                                                            </ul>
                                                        </div>
                                                    <?php  endforeach; ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 6 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-0bed168c="" data-v-7f99aea2="" class="answer-common">
                                                   <span data-v-26fdd5ec=""><?= $responses_view['response'][$res_count]['value']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 7 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                    <?php foreach ($responses_view['response'][$res_count]['value'] as $count=> $data):
                                                        if($responses_view['response'][$res_count]['value'][$count]['selected'] == 'true'){ ?>
                                                            <div data-v-9cdc19c4="" data-v-7f99aea2="" class="answer-singleoption"><?= $responses_view['response'][$res_count]['value'][$count]['name']?></div> <!---->
                                                    <?php  }  endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }
                                               else if($responses_view['response'][$res_count]['type'] == 8 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                    <div data-v-797f8d46="" data-v-7f99aea2="" class="answer-multioption">
                                                        <ul data-v-797f8d46="">
                                                    <?php foreach ($responses_view['response'][$res_count]['value'] as $count=> $data):
                                                        if($responses_view['response'][$res_count]['value'][$count]['selected'] == 'true'){ ?>
                                                            <li data-v-797f8d46=""><?= $responses_view['response'][$res_count]['value'][$count]['name']?></li>
                                                    <?php  }  endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 9 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                    <?php foreach ($responses_view['response'][$res_count]['value'] as $count=> $data):
                                                        if($responses_view['response'][$res_count]['value'][$count]['selected'] == 'true'){ ?>
                                                            <div data-v-9cdc19c4="" data-v-7f99aea2="" class="answer-singleoption"><?= $responses_view['response'][$res_count]['value'][$count]['name']?></div> <!---->
                                                    <?php  }  endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 10 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                    <div data-v-797f8d46="" data-v-7f99aea2="" class="answer-multioption">
                                                        <ul data-v-797f8d46="">
                                                    <?php foreach ($responses_view['response'][$res_count]['value'] as $count=> $data):
                                                        if($responses_view['response'][$res_count]['value'][$count]['selected'] == 'true'){ ?>
                                                            <li data-v-797f8d46=""><?= $responses_view['response'][$res_count]['value'][$count]['name']?></li>
                                                    <?php  }  endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 11 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                                    <div data-v-7fab6d66="" class="right">
                                                        <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                            <div data-v-6980cd13="" data-v-7f99aea2="" class="answer-star">
                                                                <i data-v-6980cd13="" class=""></i> <?= $responses_view['response'][$res_count]['value']; ?>
                                                            </div> <!---->
                                                        </div>
                                                    </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 12 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                        <div data-v-7fab6d66="" class="right">
                                            <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                    <div data-v-2e07b807="" data-v-7f99aea2="" class="answer-grid">
                                                        <ul data-v-2e07b807="">
                                                            <?php
                                                                foreach ($responses_view['response'][$res_count]['value'] as $count =>$data):
                                                                    echo '<li data-v-2e07b807="">'.$responses_view['response'][$res_count]['value'][$count]['name'].' : ';
                                                                    foreach ($responses_view['response'][$res_count]['value'][$count]['buttons'] as $count2 =>$data):
                                                                        if($responses_view['response'][$res_count]['value'][$count]['buttons'][$count2]['selected'] == 'true'){
                                                                            echo '<strong data-v-2e07b807="">'.$responses_view['response'][$res_count]['value'][$count]['buttons'][$count2]['name'].'</strong>';
                                                                        }
                                                                    endforeach;
                                                                    echo '</li>';
                                                                endforeach;
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 13 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                                    <div data-v-7fab6d66="" class="right">
                                                        <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                            <div data-v-6980cd13="" data-v-7f99aea2="" class="answer-star">
                                                                <i data-v-6980cd13="" class=""></i> <?= $responses_view['response'][$res_count]['value']; ?>
                                                            </div> <!---->
                                                        </div>
                                                    </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 14 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                                    <div data-v-7fab6d66="" class="right">
                                                        <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                            <div data-v-6980cd13="" data-v-7f99aea2="" class="answer-star">
                                                                <i data-v-6980cd13="" class=""></i> <?= $responses_view['response'][$res_count]['value']; ?>
                                                            </div> <!---->
                                                        </div>
                                                    </div>
                                        <?php
                                               }else if($responses_view['response'][$res_count]['type'] == 15 && $json_question['question'][$Qcount]['sequence_no'] == $res_count+1){
                                                   ?>
                                                    <div data-v-7fab6d66="" class="right">
                                                        <div data-v-7f99aea2="" data-v-7fab6d66="">
                                                            <div data-v-6980cd13="" data-v-7f99aea2="" class="answer-star">
                                                                <i data-v-6980cd13="" class=""></i> <?= $responses_view['response'][$res_count]['value']; ?>
                                                            </div> <!---->
                                                        </div>
                                                    </div>
                                        <?php
                                               }
                                               
                                               
                                          endforeach;
                                        }
                                        ?>
                                        
                                    </div>
                                <?php
                               }
                               endforeach; } //this is put question then make a loop work
                               ?>    
                           
                            

                        </div>
                    </div>
                </div>
            </div></div>
    </div> 
                <br data-v-d39bd79a=""> <!----> <!---->
            </div>


<script>
    $("#notifications_dashboard").addClass('active');
    //$("#simple-tables").addClass('active');
</script>  