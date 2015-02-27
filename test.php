<?php
echo 'hello';

        <td>
                    <select>
                        <?php foreach($attr_value as $kk=>$vv):?>
                        <option><?php echo $vv;?></option>
                        <?php enforeach;?>//少一个d->endforeach
                    </select>
                    
                </td>