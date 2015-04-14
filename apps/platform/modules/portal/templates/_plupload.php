<!-- Load Queue widget CSS and jQuery -->
<style type="text/css">@import url(/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>

<!--
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
-->

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>

<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="/plupload/js/plupload.full.js"></script>
<script type="text/javascript" src="/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<script type="text/javascript">
plupload.addI18n({
        'Select files' : '<?=__('uploader.select.files')?>',
        'Add files to the upload queue and click the start button.' : '<?=__('uploader.add.files.queue.click.start')?>',
        'Filename' : '<?=__('uploader.filename')?>',
        'Status' : '<?=__('uploader.status')?>',
        'Size' : '<?=__('uploader.size')?>',
        'Add files' : '<?=__('uploader.add.files')?>',
        'Start upload':'<?=__('uploader.start.upload')?>',
        'Stop current upload' : '<?=__('uploader.stop.current.upload')?>',
        'Start uploading queue' : '<?=__('uploader.start.uploading.queue')?>',
        'Drag files here.' : '<?=__('uploader.drag.files.here')?>'
});
</script>

<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {

    //
    var total_upload_files = 0;

	$(".uploader").pluploadQueue({
	
		// General settings
		//runtimes : 'gears,flash,silverlight,browserplus,html5',
		runtimes : 'gears,browserplus,html5,silverlight,flash',

        <?php if($type == 'propertyimage'){  ?>
		    url : '<?=url_for('portal_properties_image_upload', array('id' => $property))?>',
        <?php } elseif($type == 'developmentimage') { ?>
            url : '<?=url_for('portal_developments_image_upload', array('id' => $development))?>',
        <?php }?>


        max_file_size : '<?=sfConfig::get('app_uploader_maxsizepicture')?>mb',
		chunk_size : '1mb',
		unique_names : true,

		// Resize images on clientside if we can
		//resize : {width : 320, height : 240, quality : 90},
		resize : {width : 1024, height : 768, quality : 100},

		// Specify what files to browse for
		filters : [
			{title : "Image files", extensions : "jpg,jpeg,gif,png"}
			//{title : "Zip files", extensions : "zip"}
		],

		// Flash settings
		flash_swf_url : '/plupload/js/plupload.flash.swf',

		// Silverlight settings
		silverlight_xap_url : '/plupload/js/plupload.silverlight.xap',

        <?php if($type == 'propertyimage') { ?>
            init: {
                'FileUploaded': function(up, file, info) {
                    res = JSON.parse(info.response);

                    $('#property_images_sortable')
                        .append($('<li data-id="'+res.id+'"></li>')
                            .append('<img src="'+res.file+'">')
                            .append($('<a href="'+res.file_big+'" class="action edit" title="<?=__('upload.view')?>" rel="portal_pictures"><?=__('upload.view')?></a>').append('<img src="'+res.file+'">'))
                            .append('<a href="<?=url_for('portal_properties_image_delete')?>?id='+res.id+'" class="action delete" title="<?=__('upload.delete')?>"><?=__('upload.delete')?></a>')
                        );
                    
                    total_upload_files--;
                    if(total_upload_files==0) resetPluploader();
                },
                'QueueChanged': function(up, files){
                        total_upload_files = up.files.length;
                }
            }
        <?php } else if($type == 'developmentimage') { ?>
            init: {
                'FileUploaded': function(up, file, info) {
                    res = JSON.parse(info.response);

                    $('#development_images_sortable')
                        .append($('<li data-id="'+res.id+'"></li>')
                            .append('<img src="'+res.file+'">')
                            .append($('<a href="'+res.file_big+'" class="action edit" title="<?=__('upload.view')?>" rel="portal_pictures"><?=__('upload.view')?></a>').append('<img src="'+res.file+'">'))
                            .append('<a href="<?=url_for('portal_developments_image_delete')?>?id='+res.id+'" class="action delete" title="<?=__('upload.delete')?>"><?=__('upload.delete')?></a>')
                        );
                        
                    total_upload_files--;
                    if(total_upload_files==0) resetPluploader();
                },
                'QueueChanged': function(up, files){
                        total_upload_files = up.files.length;
                }
            }
        <?php } ?>
	});

    function resetPluploader(){
        $('div.plupload_buttons').fadeIn('fast');
        $('span.plupload_upload_status').fadeOut('fast');
    }

	// Client side form validation
	$('form').submit(function(e) {

        e.preventDefault();

        tinyMCE.triggerSave();

        var uploader = $('.uploader').pluploadQueue();

        // Files in queue upload them first
        if (uploader.files.length > 0) {
            // When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {

                    $('form')[0].submit();
                }
            });
                
            uploader.start();
        } else if($('.sortable').length == 0){
            initNotification('error', '<?=__('uploader.picturerequired')?>');
        } else {
            $('form')[0].submit();
        }

        return false;
    });
});
</script>