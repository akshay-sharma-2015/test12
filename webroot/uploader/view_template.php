
<input type="hidden" id="object_id" name="object_id" value="<?php echo $id; ?>">
<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" id="type_id" value="<?php echo $type_id; ?>">


<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade" style="float: left !important;">
        <td>
            <span class="preview"></span>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <span>cancel</span>
                </button>
            {% } %}
        </td>
        <?php /*?><td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <span>Cancel</span>
                </button>
            {% } %}
        </td><?php */?>
    </tr>
    $('table.table.table-striped').html($('table.table.table-striped').html());
{% } %}
$('table.table.table-striped').html($('table.table.table-striped').html());
</script>

<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) {  %}
    <tr class="template-download fade" style="float: left !important;">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <?php /*?><a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><?php */?><img src="{%=file.thumbnailUrl%}"><?php /*?></a><?php */?>
                {% } %}
            </span>
            <input type="hidden" name="images[]" value="{%=file.url%}"/>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="<?=$base_url;?>server/php/index?file={%=file.name%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <span>x</span>
                </button>
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <span>x</span>
                </button>
            {% } %}
        </td>
        <?php /*?><td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="<?=$base_url;?>server/php/index?file={%=file.name%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <span>Delete</span>
                </button>
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <span>Cancel</span>
                </button>
            {% } %}
        </td><?php */?>
    </tr>
    $('table.table.table-striped').html($('table.table.table-striped').html());
{% } %}
$('table.table.table-striped').html($('table.table.table-striped').html());

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
                        <span class="btn btn-sm btn-success fileinput-button"><i class="glyphicon glyphicon-upload"></i> <span>Upload</span><input type="file" name="files[]" multiple></span>
                        <!-- Webcam snaphots -->
                        <!-- Delete all files button -->
                    </div>
                </div>
            </div>
            
   
   

<!-- Edit file Modal -->


<!-- Crop image Modal -->


<!-- Crop image Modal -->
