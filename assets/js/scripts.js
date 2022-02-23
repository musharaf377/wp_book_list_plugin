jQuery(function () {

  jQuery(document).ready(function () {
    jQuery('#book_list_table').DataTable();
  });

  // add new book 
  jQuery('#add_book_form').validate({
    submitHandler: function () {

      var postdata = jQuery('#add_book_form').serialize() + "&action=book_list&param=save_book";
      jQuery.post(ajaxurl, postdata, function (response) {
        var data = jQuery.parseJSON(response);
        if (data.status == 1) {
          jQuery.notifyBar({
            cssClass: "success",
            html: data.message
          });
        } else {
          jQuery.notifyBar({
            cssClass: "error",
            html: data.message
          });
        }
      });
    }
  });

  // edit book 
  jQuery('#edit_book_form').validate({
    submitHandler: function () {
      var edit_data = jQuery('#edit_book_form').serialize() + "&action=book_list&param=edit_book";
      jQuery.post(ajaxurl, edit_data, function (response) {
        var data = jQuery.parseJSON(response);
        if (data.status == 1) {
          jQuery.notifyBar({
            cssClass: "success",
            html: data.message
          });

          // reload the page
          setTimeout(function () {
            location.reload();
          }, 2000);


        } else {
          jQuery.notifyBar({
            cssClass: "error",
            html: data.message
          });
        }
      })
    }
  })

  // delete book
  jQuery('.delete_btn').click(function () {
    var cnf = confirm('Are you sure want to delete?');
    if (cnf) {
      var delete_id = jQuery(this).attr('data-id');
      var delete_data = "action=book_list&param=delete_book&id=" + delete_id;
      jQuery.post(ajaxurl, delete_data, function (response) {
        var data = jQuery.parseJSON(response);
        console.log(data);
        if (data.status == 1) {
          jQuery.notifyBar({
            cssClass: "success",
            html: data.message
          });

          // reload the page
          setTimeout(function () {
            location.reload();
          }, 10);


        } else {
          jQuery.notifyBar({
            cssClass: "error",
            html: data.message
          });
        }
      })
    }

  })

  // image upload form media uploader
  jQuery('#upload_img').on('click', function () {
    var images = wp.media({
        title: "Upload Image for Book",
        multiple: false,
      })
      .open().on('select', function () {
        var upload_image = images.state().get('selection').first();
        var get_image = upload_image.toJSON().url;

        jQuery('#show_img').html("<img src='" + get_image + "' style='height:100px; width:100px;' />");
        jQuery('#image_name').val(get_image);

      })
  })



})