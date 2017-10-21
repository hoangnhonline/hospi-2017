<?php if(!empty($module->amenities)){ ?>

            <?php foreach($module->amenities as $amt){ if(!empty($amt->name)){ ?>
            <div style="margin-top:6px;margin-left:0px" class="row col-md-4 col-sm-4">
                <div class="row">
                    <img class="go-right" style="max-height:30px;max-witdh:40px" src="<?php echo $amt->icon;?>">
                    <span class="text-left go-text-right size14">
                    <?php echo $amt->name; ?>
                    </span>
                </div>
            </div>
            <?php } } ?>

<?php } ?>