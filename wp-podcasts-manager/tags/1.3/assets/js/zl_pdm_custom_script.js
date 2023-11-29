jQuery(document).ready(function() {
    var post_type = jQuery("select[name='zl_post_type_get']").val();
    GetCategoryPDM(post_type);

    jQuery("select[name='zl_post_type_get']").on("change", function(){
        var post_type = jQuery(this).val();
        GetCategoryPDM(post_type);
    });

    function GetCategoryPDM(post_type) {
        jQuery.ajax({
            type: "POST",
            url: wpAjax.ajaxUrl,
            data: { action: "zl_pdm_category_get", post_type: post_type },
            beforeSend: function () {
                jQuery(".zl-ajax-loader").css({ display: "inline-block" });
            },
            success: function (result) {
                jQuery(".post_type_category").html(result);
                jQuery(".zl-ajax-loader").css({ display: "none" });
            },
        });
    }

    // jQuery(".add_more").on("click", function() {
	// 	var errors = 0;
    //     jQuery('.error').remove();
    //     jQuery('.multiple_url').each(function( index ) {
    //         jQuery(this).find("input").each(function() { 
    //             if(jQuery(this).val() == '') {
    //                 jQuery(this).focus();
    //                 jQuery(this).after('<span class="error">Please enter Podcast URL</span>');
    //                 errors = 1;
    //             }
    //         })
    //     });
    //     if (errors == 1) {
    //         return false;
    //     }
    //     var data = jQuery(".zl_feed_url .multiple_url:first")[0].outerHTML;
	// 	jQuery(".zl_feed_url").append(data);
	// });
});

function copy() {
    let copyText = document.getElementById("copyClipboard");
    let copySuccess = document.getElementById("copied-success");
    copyText.select();
    copyText.setSelectionRange(0, 99999); 
    navigator.clipboard.writeText(copyText.value);
    
    copySuccess.style.opacity = "1";
    setTimeout(function(){ copySuccess.style.opacity = "0" }, 500);
}