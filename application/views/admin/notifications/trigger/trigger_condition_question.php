<?php 
$json1 = $question->options;
$question = json_decode($json1, true);
foreach ($question['question'] as $q_count=> $Q_data):
    if($question['question'][$q_count]['type'] == $type && $q_count+1 == $count){ ?>
<tr><td>
        <input type="hidden" value="<?= $count; ?>" name="q_seq[]">
        <input type="hidden" value="<?= $question['question'][$q_count]['text']['en']; ?>" name="q_name[]">
        <input type="hidden" value="<?= $type; ?>" name="q_type[]">
        <input type="hidden" value="<?= $select_condition; ?>" name="q_condition[]">
        <input type="hidden" value="<?= $condition_value; ?>" name="q_score[]">
        "Q <?= $count; ?>. <?= $question['question'][$q_count]['text']['en']; ?>" is <strong><?= $select_condition; ?> 
        <?php if($condition_value){ echo $condition_value; } ?> </strong> 
    </td>
    <td class="text-right"><a class="btn btn-default btn-xs" id="dltQuestion">X</a>
    </td>
</tr> 
    <?php }
endforeach;
?>