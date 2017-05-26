
<input type="hidden" id="object_id" name="object_id" value="<?php echo $id; ?>">
<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" id="type_id" value="<?php echo $type_id; ?>">

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="template-upload fade">
        <span class="preview"></span>
        {% if (file.error) { %}
           <span class="label label-danger">Error</span>
        {% } %}
        {% if (!o.files.error) { %}
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            	<div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        {% } %}
    </li>
{% } %}
</script>

<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <li class="template-download fade {% if (file.image) { %}image{% } %}" id="sort_{%=file.id%}" data-file="{%=file.name%}">
    	{% if (file.error) { %}
            <span class="label label-danger">Error</span>
        {% } %}
        {% if (!file.error) { %}
            <span class="preview" title="{%=file.title%}">
                {% if (file.image) { %}
            	   <a href="{%=file.url%}" title="{%=file.title%}" data-lightbox="gallery-{%=file.object_id%}"><img src="{%=file.thumbnailUrl%}" width="80" height="80"></a>
                {% } else { %}
                    <span class="filetype {%=file.filetype%}"></span>
                {% } %}
            </span>
            <div class="description">{%=file.description%}</div>            
            <div class="actions">
            	
                <i class="glyphicon glyphicon-trash delete-file" title="Delete"></i>
            </div>
        {% } %}
    </li>
{% } %}
</script>

<!-- Upload Modal -->

            <div class="modal-body">
                 <!-- Hidden alert message -->
                <div class="alert alert-danger upload-max">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     You have exceeded the limit of uploaded images.
                </div>
                 <div id="fileupload">   
                    <!-- Images list -->
                    <ul class="files images"></ul>
                    <br clear="all">
                   
                     <!-- Attachments list -->
                    <ul class="files attachments"></ul>
                     <br clear="all">

                    <div class="loading-files"></div>

                    <div class="fileupload-buttonbar">
                        <!-- Upload files button -->
                        <span class="btn btn-sm btn-success fileinput-button"><i class="glyphicon glyphicon-upload"></i> <span><?php echo __('Upload',true); ?></span><input type="file" name="files[]" multiple></span>
                        <!-- Webcam snaphots -->
                        <!-- Delete all files button -->
                    </div>
                </div>
            </div>
            
   
   

<!-- Edit file Modal -->


<!-- Crop image Modal -->


<!-- Crop image Modal -->
