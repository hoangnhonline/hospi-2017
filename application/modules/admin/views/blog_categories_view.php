<div class="panel panel-default">
    <div class="panel-heading"><?php echo $header_title; ?></div>

    <div class="panel-body">
        <div class="add_button_modal">
            <button type="button" data-toggle="modal" data-target="#ADD_BLOG_CAT" class="btn btn-success"><i
                        class="glyphicon glyphicon-plus-sign"></i> Thêm mới
            </button>
        </div>
        <?php echo $content; ?>
    </div>
</div>


<!--Add blog category Modal -->
<div class="modal fade" id="ADD_BLOG_CAT" tabindex="-1" role="dialog" aria-labelledby="ADD_BLOG_CAT" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add Blog Category Type</h4>
                </div>
                <div class="modal-body form-horizontal">
                    <div class="row form-group">
                        <label class="col-md-3 control-label text-left">Category Name</label>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 control-label text-left">Status</label>
                        <div class="col-md-8">
                            <select name="status" class="form-control">
                                <option value="Yes">Enable</option>
                                <option value="No">Disable</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 control-label text-left">Parent Name</label>
                        <div class="col-md-8">
                            <select data-placeholder="Select" name="parent" class="form-control">
                                <option value="">Select</option>
                                <?php foreach ($categoriesparent['all'] as $cat) { ?>
                                    <option value="<?php echo $cat->cat_id; ?>"> <?php echo $cat->cat_name; ?> </option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 control-label text-left">Layout</label>
                        <div class="col-md-8">
                            <select data-placeholder="Select" name="layout" class="form-control">
                                <option value="1">Layout 1</option>
                                <option value="2">Layout 2</option>
                                <option value="3">Layout 3</option>
                                <option value="4">Layout 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-3 control-label text-left">Class Name</label>
                        <div class="col-md-8">
                            <input type="text" name="classname" class="form-control" placeholder="Class Name" value="cat-blue">
                        </div>
                    </div>
                    <?php foreach ($languages as $lang => $val) {
                        if ($lang != DEFLANG) { ?>
                            <div class="row form-group">
                                <label class="col-md-3 control-label text-left"> Name in <img
                                            src="<?php echo PT_LANGUAGE_IMAGES . $lang . ".png" ?>" height="20" alt=""/>&nbsp;<?php echo $val['name']; ?>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" name='<?php echo "translated[$lang][name]"; ?>'
                                           class="form-control" placeholder="Name" value="">
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="addcat" value="1"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-----end add category modal------>

<!-- edit Modal -->
<?php foreach ($categories['all'] as $cat) { ?>
    <div class="modal fade" id="cat<?php echo $cat->cat_id; ?>" tabindex="-1" role="dialog" aria-labelledby=""
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Update</h4>
                    </div>
                    <div class="modal-body form-horizontal">
                        <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Category Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" placeholder="Name"
                                       value="<?php echo $cat->cat_name; ?>" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Status</label>
                            <div class="col-md-8">
                                <select name="status" class="form-control" id="">
                                    <option value="Yes" <?php makeSelected($cat->cat_status, "Yes"); ?>>Enabled</option>
                                    <option value="No" <?php makeSelected($cat->cat_status, "No"); ?> >Disable</option>
                                </select></div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Parent Name</label>
                            <div class="col-md-8">
                                <select data-placeholder="Select" name="parent" class="form-control" tabindex="2">
                                    <option value="">Select</option>
                                    <?php foreach ($categoriesparent['all'] as $parentcat) {
                                        if ($cat->cat_id != $parentcat->cat_id) { ?>
                                            <option value="<?php echo $parentcat->cat_id; ?>" <?php makeSelected($cat->cat_parent, $parentcat->cat_id); ?> > <?php echo $parentcat->cat_name; ?> </option>
                                        <?php }
                                    } ?>

                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Layout</label>
                            <div class="col-md-8">
                                <select data-placeholder="Select" name="layout" class="form-control">
                                    <option value="1" <?php makeSelected($cat->cat_layout, 1); ?>>Layout 1</option>
                                    <option value="2" <?php makeSelected($cat->cat_layout, 2); ?>>Layout 2</option>
                                    <option value="3" <?php makeSelected($cat->cat_layout, 3); ?>>Layout 3</option>
                                    <option value="4" <?php makeSelected($cat->cat_layout, 4); ?>>Layout 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-3 control-label text-left">Class Name</label>
                            <div class="col-md-8">
                                <input type="text" name="classname" class="form-control" placeholder="Class Name" value="<?php echo $cat->cat_classname; ?>">
                            </div>
                        </div>
                        <?php foreach ($languages as $lang => $val) {
                            if ($lang != DEFLANG) {
                                @$trans = getBlogCategoriesTranslation($lang, $cat->cat_id); ?>
                                <div class="row form-group">
                                    <label class="col-md-3 control-label text-left"> Name in <img
                                                src="<?php echo PT_LANGUAGE_IMAGES . $lang . ".png" ?>" height="20"
                                                alt=""/>&nbsp;<?php echo $val['name']; ?></label>
                                    <div class="col-md-8">
                                        <input type="text" name='<?php echo "translated[$lang][name]"; ?>'
                                               class="form-control" placeholder="Name"
                                               value="<?php echo @$trans[0]->cat_name; ?>">
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="updatecat" value="1"/>
                        <input type="hidden" name="categoryid" value="<?php echo $cat->cat_id; ?>"/>
                        <input type="hidden" name="slug" value="<?php echo $cat->cat_slug; ?>"/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<!----edit modal--->